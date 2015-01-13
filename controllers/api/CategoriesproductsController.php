<?php
namespace app\controllers\api;

use yii\rest\ActiveController;
use yii\helpers\Json;

class CategoriesproductsController extends ActiveController
{            
    public $modelClass = 'app\models\CategoriesProducts';
        
    public function actionGetcategoriesproduct($id_product)//получает категории для товара
    {        
        $model = new \app\models\CategoriesProducts();
        echo Json::encode($model->getCategoryProduct($id_product));
    }
    
    public function actionGetcategoriesproducts()//получает все категории которым принадлежат товары
    {        
        $model = new \app\models\CategoriesProducts();
        echo Json::encode($model->getCategoriesProducts());
    }
}