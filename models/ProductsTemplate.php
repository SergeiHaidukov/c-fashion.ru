<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Products_Template".
 *
 * @property integer $id_prod_temp
 * @property integer $id_product
 * @property integer $id_color
 * @property integer $id_size
 */
class ProductsTemplate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Products_Template';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_product', 'id_color', 'id_size'], 'required'],
            [['id_product', 'id_color', 'id_size'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_prod_temp' => 'Id Prod Temp',
            'id_product' => 'Id Product',
            'id_color' => 'Id Color',
            'id_size' => 'Id Size',
        ];
    }
    
    public function getColorsProduct($id_product) {//получает цвета для товара
        
        $query = (new \yii\db\Query())
                ->select('*')
                ->where(['pt.id_product' => $id_product, ])
                ->from('Colors c')
                ->leftJoin('Products_Template pt', 'c.id_color = pt.id_color')
                ->leftJoin('Sizes s', 'pt.id_size = s.id_size')
                ->leftJoin('Products p', 'pt.id_product = p.id_product');                
        $command = $query->createCommand();
        $colors = $command->queryAll();
                
        return ($colors);
    }
    
    public function getSizesProducts() {//получает размеры, которые привязаны к товарам

        $primaryConnection = Yii::$app->db;
        $command = $primaryConnection->createCommand('SELECT  s.id_size, s.size_name FROM Sizes s JOIN Products_Template pt ON s.id_size = pt.id_size GROUP BY s.size_name');
        $cat = $command->queryAll();
        
        return ($cat);
    }   
    
    public function getColorsProducts() {//получает цвета которые назначены товарам

        $primaryConnection = Yii::$app->db;
        $command = $primaryConnection->createCommand('SELECT * FROM Colors c JOIN Products_Template pt ON c.id_color = pt.id_color GROUP BY c.id_color');
        $cat = $command->queryAll();
        
        return ($cat);
    }   
}
