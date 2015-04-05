<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Categories_Products".
 *
 * @property integer $id
 * @property integer $id_category
 * @property integer $id_product
 */
class CategoriesProducts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Categories_Products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_category', 'id_product'], 'required'],
            [['id_category', 'id_product'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_category' => 'Id Category',
            'id_product' => 'Id Product',
        ];
    }
    
    public function getCategoryProduct($id_product) {//получает категории для товара
        
        $query = (new \yii\db\Query())
                ->select('cp.id,
                        c.id_category,
                        c.name')
                ->where(['cp.id_product' => $id_product, ])
                ->from('Categories c')
                ->leftJoin('Categories_Products cp', 'c.id_category = cp.id_category')
                ->leftJoin('Products p', 'cp.id_product = p.id_product');
        $command = $query->createCommand();
        $cat = $command->queryAll();
                
        return ($cat);
    }
    
    public function getCategoriesProducts() {//получает все категории которым принадлежат товары
        
//        $query = (new \yii\db\Query())
//                ->select('c.id_category,
//                            c.name')               
//                ->from('Categories c')
//                ->leftJoin('Categories_Products cp', 'c.id_category = cp.id_category')
//                ->groupBy(['c.id_category', 'c.name']);
//        $command = $query->createCommand();

        $primaryConnection = Yii::$app->db;
        $command = $primaryConnection->createCommand('SELECT  c.id_category, c.name FROM Categories c JOIN Categories_Products cp ON c.id_category = cp.id_category GROUP BY c.id_category');
        $cat = $command->queryAll();        
        
        return ($cat);
    }
}
