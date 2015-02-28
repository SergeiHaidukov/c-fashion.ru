<?php
namespace app\controllers\api;

use Yii;
use yii\rest\ActiveController;
use yii\helpers\Json;

class ProductstemplateController extends ActiveController
{            
    public $modelClass = 'app\models\ProductsTemplate';
    
    public function actionGetcolorsproduct($id_product)//получает цвета для товара
    {        
        $model = new \app\models\ProductsTemplate();
        echo Json::encode($model->getColorsProduct($id_product));
    }
    
    public function actionGetsizesproducts()//получает все размеры, которые принадлежат товарам
    {        
        $model = new \app\models\ProductsTemplate();
        echo Json::encode($model->getSizesProducts());
    }
    
    public function actionGetcolorsproducts()//получает все цвета которые назначены товарам
    {        
        $model = new \app\models\ProductsTemplate();
        echo Json::encode($model->getColorsProducts());
    }
}