<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Product_Attribute_Template".
 *
 * @property integer $id_pat
 * @property string $name_pat
 */
class ProductAttributeTemplate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Product_Attribute_Template';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_pat'], 'required'],
            [['name_pat'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_pat' => 'Id Pat',
            'name_pat' => 'Name Pat',
        ];
    }
}
