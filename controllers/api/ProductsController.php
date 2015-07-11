<?php
namespace app\controllers\api;

use Yii;
use yii\rest\ActiveController;
use yii\helpers\Json;

class ProductsController extends ActiveController
{            
    public $modelClass = 'app\models\Products';
    
    public function actionGetminiature()//выбираем товары с миниатюрами
    {        
        $model = new \app\models\Products();
        $products = $model->getProductsMiniture();
        echo Json::encode($products);
    }
    
    function actionGetproductsfilter() {//выбираем товары и их свойства
        $model = new \app\models\Products();
        $products = $model->getProductsFilter();
        echo Json::encode($products);
    }
    
    function actionGetproductpictures($id_product) {//изображения товара
        $model = new \app\models\PicturesProducts();
        $products = $model->getPicturesProduct($id_product);
        echo Json::encode($products);
    }
    
}