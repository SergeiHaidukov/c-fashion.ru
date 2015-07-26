<?php

namespace app\controllers;

use Yii;
use app\models\Products;
use app\models\ProductsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\imagine\Image;
use yii\helpers\Json;
//use yii\imagine\Gd\Image;

/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],            
//            'timestamp' => [
//            'class' => \yii\behaviors\TimestampBehavior::className(),
//            'attributes' => [
//                \yii\db\BaseActiveRecord::EVENT_BEFORE_INSERT => ['create_date', 'last_update'],
//                \yii\db\BaseActiveRecord::EVENT_BEFORE_UPDATE => ['last_update'],
//            ],
//            'value' => new \yii\db\Expression('NOW()'),
//            ],
        ];        
    }

    /**
     * Lists all Products models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!YII::$app->user->can('crudProducts'))
            {
               $this->redirect(array('/login'));
            }
        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Products model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (!YII::$app->user->can('crudProducts'))
            {
               $this->redirect(array('/login'));
            }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!YII::$app->user->can('crudProducts'))
            {
               $this->redirect(array('/login'));
            }
        $model = new Products();        
        $model->create_date = new \yii\db\Expression('NOW()');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id_product]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    
    public function actionProgressive()
    {
        if (!YII::$app->user->can('crudProducts'))
            {
               $this->redirect(array('/login'));
            }
            $images = \app\models\Pictures::find()->all();
            $default = ini_get('max_execution_time');
            set_time_limit(0);
            foreach ($images as $image)
            {
//                $im = imagecreatefromjpeg('img/' .$image['file_name']);
//                imageinterlace($im, true);
//                imagejpeg($im,'img/' .$image['file_name']);
                $fileName = $image['file_name'];
                
                if (file_exists('img/' .$fileName)) 
                {                                                            

                    $mode = \Imagine\Image\ImageInterface::THUMBNAIL_INSET;

                        $width_new = 440;
                        $height_new = 586;
                        $image_info = getimagesize('img/' .$fileName);
                        
                        if($image_info != false)
                        {
                            if($image_info[0] < $width_new) { $width_new = $image_info[0]; $height_new = $image_info[0]; }
                            if($image_info[1] < $height_new) { $height_new = $image_info[1]; $width_new = $image_info[1]; }
                            Image::thumbnail('img/' .$fileName, $width_new, $height_new, $mode)
                            ->save(Yii::getAlias('@webroot/img/thumbnail/' .$fileName), ['quality' => 90]);
                        }
                        else {
                            var_dump($fileName);
                            var_dump($image_info);
                            var_dump($width_new);
                            var_dump($height_new);
                        }                                                                        

                        $width_new = 100;
                        $height_new = 75;                        
                        if($image_info != false)
                        {
                            if($image_info[0] < $width_new) { $width_new = $image_info[0]; $height_new = $image_info[0]; }
                            if($image_info[1] < $height_new) { $height_new = $image_info[1]; $width_new = $image_info[1]; }
                            Image::thumbnail('@webroot/img/' .$fileName, $width_new, $height_new, $mode)
                            ->save(Yii::getAlias('@webroot/img/thumbnail/mini/' .$fileName), ['quality' => 90]);
                        }
                        else {
                            var_dump($fileName);
                            var_dump($image_info);
                            var_dump($width_new);
                            var_dump($height_new);
                        }                                                

                    $picturesmodel = new \app\models\Pictures();
                    $picprodmodel = new \app\models\PicturesProducts();

                    $picturesmodel->file_name = $fileName;
                    $picturesmodel->save();

                    $picprodmodel->id_picture = $picturesmodel->id_picture;
                    $picprodmodel->id_product = $model->id_product;
                    $picprodmodel->save();
                }                 
            }
            set_time_limit($default);
            
            
    }


    public function actionUpdate($id)
    {
        if (!YII::$app->user->can('crudProducts'))
            {
               $this->redirect(array('/login'));
            }
        $model = $this->findModel($id);
        $model->last_update = new \yii\db\Expression('NOW()');
        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstances($model, 'file');

            if ($model->file && $model->validate()) {
                //$i = 60;
                foreach ($model->file as $file) {
                    $baseName = $model->id_product.'_'.md5(uniqid(rand(),true));
                    /*if($i<10) {$baseName = 'conf0'.$i;}
                    else {$baseName = 'conf'.$i;}*/
                    $fileName = $baseName . '.' . $file->extension;                    
                    $file->saveAs('img/' .$fileName);
//                    $im = imagecreatefromjpeg('img/' .$fileName);                    
//                    imageinterlace($im, true);
//                    imagejpeg($im,'img/' .$fileName);
                    
                    $mode = \Imagine\Image\ImageInterface::THUMBNAIL_INSET;
                    
                    $width_new = 440;
                    $height_new = 586;
                    $image_info = getimagesize('img/' .$fileName);
                    
                    if($image_info[0] < $width_new) { $width_new = $image_info[0]; $height_new = $image_info[0]; }
                    if($image_info[1] < $height_new) { $height_new = $image_info[1]; $width_new = $image_info[1]; }
                    
                    Image::thumbnail('@webroot/img/' .$fileName, $width_new, $height_new, $mode)
                    ->save(Yii::getAlias('@webroot/img/thumbnail/' .$fileName), ['quality' => 90]);                                         
                    
                    $width_new = 100;
                    $height_new = 75;
                    $image_info = getimagesize('img/' .$fileName);
                    
                    if($image_info[0] < $width_new) { $width_new = $image_info[0]; $height_new = $image_info[0]; }
                    if($image_info[1] < $height_new) { $height_new = $image_info[1]; $width_new = $image_info[1]; }
                    
                    Image::thumbnail('@webroot/img/' .$fileName, $width_new, $height_new, $mode)
                    ->save(Yii::getAlias('@webroot/img/thumbnail/mini/' .$fileName), ['quality' => 90]);
                    
                    $picturesmodel = new \app\models\Pictures();
                    $picprodmodel = new \app\models\PicturesProducts();
                    
                    $picturesmodel->file_name = $fileName;
                    $picturesmodel->save();
                    
                    $picprodmodel->id_picture = $picturesmodel->id_picture;
                    $picprodmodel->id_product = $model->id_product;
                    $picprodmodel->save();                    
                    //$i++;                    
                }
            }
        }
        $files = $model->getImage($model->id_product);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {            
            return $this->redirect('update', [
                'id' => $model->id_product,
                'files' => $files,
                ]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'files' => $files,
            ]);
        }
    }

    /**
     * Deletes an existing Products model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (!YII::$app->user->can('crudProducts'))
            {
               $this->redirect(array('/login'));
            }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }    

    /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionDelpicprod($id_product, $id_picture)
    {
        if (!YII::$app->user->can('crudProducts'))
            {
               $this->redirect(array('/login'));
            }
        try{
            $picture = \app\models\Pictures::findOne($id_picture);
            $picture->delete();      
            \app\models\PicturesProducts::deleteAll('id_picture = :id_picture AND id_product = :id_product',
                                                    [':id_picture'=>$id_picture, ':id_product'=>$id_product]);
            $picture->delImageFile(Yii::getAlias('@webroot/img/thumbnail/'.$picture->file_name));
            $picture->delImageFile(Yii::getAlias('@webroot/img/'.$picture->file_name));
        } catch (Exception $ex) {
            throw new NotFoundHttpException($ex);
        }  
        
        $model = $this->findModel($id_product);
        return $this->redirect(['update', 'id' => $model->id_product]);                
    }
    
    public function actionSetproductminiature($id_product, $id_picture_product, $is_miniature)
    {
        if (!YII::$app->user->can('crudProducts'))
            {
               $this->redirect(array('/login'));
            }
        try{
            $picture_product = new \app\models\PicturesProducts();
            $picture_product->setMiniature($id_product, $id_picture_product, $is_miniature);
        } catch (Exception $ex) {
            throw new NotFoundHttpException($ex);
        }  
        
        $model = $this->findModel($id_product);
        return $this->redirect(['update', 'id' => $model->id_product]);                
    }
    
    public function actionList() 
    {
        if (!YII::$app->user->can('crudProducts'))
            {
               $this->_sendResponse(403);
            }
        //$products = Products::find()->where(['isview' => 1])->all();        
        $model = new Products();
        $products = $model->getProductsMiniture();
        echo Json::encode($products);        
    }
}
