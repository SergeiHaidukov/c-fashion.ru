<?php
namespace app\controllers\api;

use Yii;
use yii\rest\ActiveController;
use yii\helpers\Json;

class CategoriesController extends ActiveController
{            
    public $modelClass = 'app\models\Categories';
    
//    public function setCategoryProduct($id_category, $id_product){
//        if (!YII::$app->user->can('crudCategories'))
//            {
//               $this->redirect(array('/login'));
//            }
//        $catprod = new \app\models\CategoriesProducts();
//        $catprod->id_category = $id_category;
//        $catprod->id_product = $id_product;
//        if ($catprod->save())
//        {
//            echo Json::encode('true');
//        }
//        else { echo Json::encode('false'); }
//    }
}