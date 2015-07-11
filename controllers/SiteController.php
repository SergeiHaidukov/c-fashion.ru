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

    public function actionIndex()
    {
        parse_str($_SERVER['QUERY_STRING'], $output);
        
        $products_model = new \app\models\Products();
        $products = $products_model->getFilteredProducts($output);
        $categories_model = new \app\models\CategoriesProducts();
        $categories = $categories_model->getCategoriesProducts();
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
        
        $products_model = new \app\models\Products();
        $model = \app\models\Products::findOne($id_product);        
        $product_images = $model->getImage($model->id_product);
        $main_photo_name = explode(",", $query_param['product_main_photo'])[0];
        $products_template_model = new \app\models\ProductsTemplate();
        $products_template_array = $products_template_model->getColorsProduct($id_product);
        return $this->render('productpage', [
            'model' => $model,
            'product_images' => $product_images,
            'products_model' => $products_model,
            'main_photo_name' => $main_photo_name,
            'products_template_array' => $products_template_array,
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
}
