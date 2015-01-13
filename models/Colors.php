<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Colors".
 *
 * @property integer $id_color
 * @property string $name
 * @property string $code
 */
class Colors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Colors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'code'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_color' => 'Id Color',
            'name' => 'Name',
            'code' => 'Code',
        ];
    }
}
