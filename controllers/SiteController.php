<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\UploadForm;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex($category_translit_name = '')
    {
        parse_str($_SERVER['QUERY_STRING'], $query_param);
        
        var_dump($category_from_url);                
        $session = \Yii::$app->session;
        
        if($category_translit_name != '')
        {                        
            //var_dump($current_category_id_from_url);
            if($category_translit_name != $session->get('category_translit_name'))
            {
                //var_dump($current_category_id_from_url);                
                $this->actionSetsessionparam('category_translit_name', $category_translit_name);
            }
            //var_dump(yii\helpers\Url::to(['site/setsessionparam', 'param_name'=>'category', 'param_value'=> $cat['id_category']]));
            //return $this->redirect(yii\helpers\Url::to(['site/setsessionparam', 'param_name'=>'category', 'param_value'=> $cat['id_category']]));
        }
        else
        {
            if($session->get('category_translit_name') != '')
            {
                return $this->redirect(['/'.$session->get('category_translit_name')]);
            }
        }
        
        $products_model = new \app\models\Products();
        $products = $products_model->getFilteredProducts($query_param);
        $categories_model = new \app\models\CategoriesProducts();
        $categories = $categories_model->getCategoriesProducts();
        $current_category_id = $session->get('category');
        $current_sizes_id = $session->get('sizes');
        $current_colors_id = $session->get('colors');
        $prodtuctstemplate_model = new \app\models\ProductsTemplate();
        $sizes = $prodtuctstemplate_model->getSizesProducts();
        $colors = $prodtuctstemplate_model->getColorsProducts();
        
        //var_dump($colors);
        //$products_filter = $model->getFilteredProducts($output);
        
        return $this->render('index', [
            'products' => $products,
            'products_model' => $products_model,
            'categories' => $categories,
            'sizes' => $sizes,
            'colors' => $colors,
            'current_category_id' => $current_category_id,
            'current_sizes_id' => $current_sizes_id,
            'current_colors_id' => $current_colors_id,
            //'output' => $output,
            //'products_filter' => $products_filter
        ]);        
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {        
            return $this->render('contact', [
                'model' => $model,
            ]);        
    }
    
    public function actionKupon()
    {
            return $this->render('kupon', [
                'model' => $model,
            ]);        
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
    
    public function actionProductpage($id_product)
    {        
        parse_str($_SERVER['QUERY_STRING'], $query_param);
        $session = \Yii::$app->session;
        
        $products_model = new \app\models\Products();
        $model = \app\models\Products::findOne($id_product);        
        $product_images = $model->getImage($model->id_product);
        $main_photo_name = explode(",", $query_param['product_main_photo'])[0];
        $products_template_model = new \app\models\ProductsTemplate();
        $products_template_array = $products_template_model->getColorsProduct($id_product);
        $cat_translit_name = $session->get('category_translit_name');
        return $this->render('productpage', [
            'model' => $model,
            'product_images' => $product_images,
            'products_model' => $products_model,
            'main_photo_name' => $main_photo_name,
            'products_template_array' => $products_template_array,
            'cat_translit_name' => $cat_translit_name,
        ]);
    }
    
    public function actionProductslist()
    {
        $model = new \app\models\Products();        
        return $this->render('productslist', ['model' => $model]);
    }
    
    public function actionUpload()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstances($model, 'file');

            if ($model->file && $model->validate()) {
                foreach ($model->file as $file) {
                    $file->saveAs('uploads/' . $file->baseName . '.' . $file->extension);
                }
            }
        }

        return $this->render('upload', ['model' => $model]);
    }
    
    public function actionSetsessionparam($param_name, $param_value)
    {
        $session = \Yii::$app->session;
                
        $params = $session->get($param_name);
        
        if($param_name == 'category_translit_name')
        {            
            $query = (new \yii\db\Query())
            ->select('c.id_category')
            ->from('Categories c');
            $query->andWhere(['c.translit_name' => $param_value]);
            
            $current_category_id_from_url = $query->createCommand()->queryScalar();
            
            if($session->get('category')==$current_category_id_from_url)
            {
                $session->set('category', NULL);
                $session->set($param_name, NULL);
            }
            else {$session->set('category', $current_category_id_from_url);
                  $session->set($param_name, $param_value);}            
        return $this->redirect(['index']);
        }
        
        $count = 0;
        $param_array = array();
        if(is_array($params))
        {            
           $param_array = $params; 
           foreach ($param_array as $key => $value)
           {
               if($value == $param_value)
               {
                   $count++;
                   unset($param_array[$key]);
               }
           }
           if($count == 0)
           {
               array_push($param_array, $param_value);
           }   
        }
        else 
        {
            if($params == $param_value)
            {
                $param_array = null;
            }
            else
            {
                array_push($param_array, $params, $param_value);
            }
        }
        
        $session->set($param_name, $param_array);
        return $this->redirect(['/'.$session->get('category_translit_name')]);
    }
    
    public function actionGetsessionparam($param_name)
    {        
        $session = \Yii::$app->session;
        var_dump($session->get($param_name));
    }
    
    public function actionClearsessionparam()
    {        
        $session = \Yii::$app->session;
        $session->set('category',NULL);
        $session->set('category_translit_name',NULL);
        $session->set('sizes', array());
        $session->set('colors', array());
        return $this->redirect(['index']);
    }
}
