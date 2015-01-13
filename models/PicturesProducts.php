<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Pictures_Products".
 *
 * @property integer $ID
 * @property integer $id_picture
 * @property integer $id_product
 * @property integer $is_miniature
 */
class PicturesProducts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Pictures_Products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_picture', 'id_product'], 'required'],
            [['id_picture', 'id_product', 'is_miniature'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'id_picture' => 'Id Picture',
            'id_product' => 'Id Product',
            'is_miniature' => 'Is Miniature',
        ];
    }
    
    public function setMiniature($id_product, $id_picture_product) 
    {
        $model = $this->findOne($id_picture_product);
//        $query = (new \yii\db\Query())
//                ->update('Pictures_Products pp')
//                ->set('pp.is_miniature = 0')
//                ->where('pp.id_product = 1');
        
        PicturesProducts::updateAll(['is_miniature'=> '0'], ['is_miniature'=>'1' ,'id_product'=>$id_product]);
        
        $model->is_miniature = 1;
        $model->save();
    }
    
    public function getPicturesProduct($id_product) {//получает изображения для товара
        
        $query = (new \yii\db\Query())
                ->select('p.id_picture,
                            p.file_name,
                            pp.is_miniature')
                ->where(['p1.id_product' => $id_product, ])
                ->from('Pictures p')
                ->leftJoin('Pictures_Products pp', 'p.id_picture = pp.id_picture')
                ->leftJoin('Products p1', 'pp.id_product = p1.id_product');
        $command = $query->createCommand();
        $sizes = $command->queryAll();
                
        return ($sizes);
    }
}
