<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Sizes".
 *
 * @property integer $id_size
 * @property string $name
 */
class Sizes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Sizes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_size' => 'Id Size',
            'name' => 'Name',
        ];
    }
}
