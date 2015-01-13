<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Sizes_Products".
 *
 * @property integer $ID
 * @property integer $id_size
 * @property integer $id_product
 */
class SizesProducts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Sizes_Products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_size', 'id_product'], 'required'],
            [['id_size', 'id_product'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'id_size' => 'Id Size',
            'id_product' => 'Id Product',
        ];
    }
    
    public function getSizesProduct($id_product) {//получает размеры для товара
        
        $query = (new \yii\db\Query())
                ->select('s.id_size,
                            s.name,
                            sp.ID')
                ->where(['sp.id_product' => $id_product, ])
                ->from('Sizes s')
                ->leftJoin('Sizes_Products sp', 's.id_size = sp.id_size')
                ->leftJoin('Products p', 'sp.id_product = p.id_product');
        $command = $query->createCommand();
        $sizes = $command->queryAll();
                
        return ($sizes);
    }
    
    public function getSizesProducts() {//получает категории которые привязаны к товарам

        $primaryConnection = Yii::$app->db;
        $command = $primaryConnection->createCommand('SELECT  s.id_size, s.name FROM Sizes s JOIN Sizes_Products sp ON s.id_size = sp.id_size GROUP BY s.id_size');
        $cat = $command->queryAll();
        
        return ($cat);
    }    
}
