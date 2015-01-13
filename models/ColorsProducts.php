<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Colors_Products".
 *
 * @property integer $ID
 * @property integer $id_color
 * @property integer $id_product
 */
class ColorsProducts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Colors_Products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_color', 'id_product'], 'required'],
            [['id_color', 'id_product'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'id_color' => 'Id Color',
            'id_product' => 'Id Product',
        ];
    }
    
    public function getColorsProduct($id_product) {//получает цвета для товара
        
        $query = (new \yii\db\Query())
                ->select('c.id_color,
                            c.name,
                            cp.ID,
                            c.code')
                ->where(['cp.id_product' => $id_product, ])
                ->from('Colors c')
                ->leftJoin('Colors_Products cp', 'c.id_color = cp.id_color')
                ->leftJoin('Products p', 'cp.id_product = p.id_product');
        $command = $query->createCommand();
        $colors = $command->queryAll();
                
        return ($colors);
    }
    
    public function getColorsProducts() {//получает цвета которые назначены товарам

        $primaryConnection = Yii::$app->db;
        $command = $primaryConnection->createCommand('SELECT * FROM Colors c JOIN Colors_Products cp ON c.id_color = cp.id_color GROUP BY c.id_color');
        $cat = $command->queryAll();
        
        return ($cat);
    }   
}
