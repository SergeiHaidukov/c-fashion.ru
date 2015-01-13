<?php
namespace app\controllers\api;

use yii\rest\ActiveController;
use yii\helpers\Json;

class ColorsproductsController extends ActiveController
{            
    public $modelClass = 'app\models\ColorsProducts';
        
    public function actionGetcolorsproduct($id_product)//получает категории для товара
    {        
        $model = new \app\models\ColorsProducts();
        echo Json::encode($model->getColorsProduct($id_product));
    }
    
    public function actionGetcolorsproducts()//получает все цвета которые назначены товарам
    {        
        $model = new \app\models\ColorsProducts();
        echo Json::encode($model->getColorsProducts());
    }
}