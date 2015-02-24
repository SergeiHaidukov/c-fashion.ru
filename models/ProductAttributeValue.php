<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Product_Attribute_Value".
 *
 * @property integer $id_pav
 * @property integer $id_pat
 * @property string $value_pav
 * @property integer $parent
 */
class ProductAttributeValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Product_Attribute_Value';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_pat', 'value_pav'], 'required'],
            [['id_pat', 'parent'], 'integer'],
            [['value_pav'], 'string', 'max' => 255]
        ];
    }
    
    public function relations()
    {
        return array(
            'id_pat' => array(self::HAS_Many, 'Product_Attribute_Template', 'id_pat'),            
        );
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_pav' => 'Id Pav',
            'id_pat' => 'Id Pat',
            'value_pav' => 'Value Pav',
            'parent' => 'Parent',
        ];
    }
}
