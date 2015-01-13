<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Pictures".
 *
 * @property integer $id_picture
 * @property string $file_name
 */
class Pictures extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Pictures';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file_name'], 'required'],
            [['file_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_picture' => 'Id Picture',
            'file_name' => 'File Name',
        ];
    }
    
    public function delImageFile($file)
    {
        // check if file exists on server
        if (empty($file) || !file_exists($file)) {
            return false;
        }
 
        // check if uploaded file can be deleted on server
        if (!unlink($file)) {
            return false;
        }
    }
    
    
}
