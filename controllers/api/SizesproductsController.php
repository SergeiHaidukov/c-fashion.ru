<?php
namespace app\controllers\api;

use yii\rest\ActiveController;
use yii\helpers\Json;

class SizesproductsController extends ActiveController
{            
    public $modelClass = 'app\models\SizesProducts';
        
    public function actionGetsizesproduct($id_product)//получает категории для товара
    {        
        $model = new \app\models\SizesProducts();
        echo Json::encode($model->getSizesProduct($id_product));
    }
    
    public function actionGetsizesproducts()//получает все категории которым принадлежат товары
    {        
        $model = new \app\models\SizesProducts();
        echo Json::encode($model->getSizesProducts());
    }
}