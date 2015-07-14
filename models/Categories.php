<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Categories".
 *
 * @property integer $id_category
 * @property string $name
 * @property string $translit_name
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'translit_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_category' => 'Id Category',
            'name' => 'Name',
            'translit_name' => 'Translit Name',
        ];
    }
}
