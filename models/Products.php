<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Products".
 *
 * @property integer $id_product
 * @property string $name
 * @property double $price
 * @property double $oldprice
 * @property string $url
 * @property integer $isview
 * @property string $description
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Products';
    }
    public $file;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'url'], 'required'],
            [['price', 'oldprice'], 'number'],
            [['isview'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 50],
            [['url'], 'string', 'max' => 255],
            [['file'], 'file', 'extensions' => ['jpg'], 'maxFiles' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_product' => 'Id Product',
            'name' => 'Name',
            'price' => 'Price',
            'oldprice' => 'Oldprice',
            'url' => 'Url',
            'isview' => 'Isview',
            'description' => 'Description',
        ];
    }
    
    public function getImage($id_product)//изображения товара
    {
        $query = (new \yii\db\Query())
                ->select('*')
                ->where(['pp.id_product' => $id_product, ])
                ->from('Pictures p')
                ->leftJoin('Pictures_Products pp', 'p.id_picture = pp.id_picture');                
        $command = $query->createCommand();
        $images = $command->queryAll();
                
        return ($images);
    }
    
    public function getProductsMiniture()
    {
        $query = (new \yii\db\Query())
                ->select('*')
                ->where(['pp.is_miniature' => 1, ])
                ->from('Products p')
                ->leftJoin('Pictures_Products pp', 'p.id_product = pp.id_product')
                ->leftJoin('Pictures p1', 'pp.id_picture = p1.id_picture');
        $command = $query->createCommand();
        $images = $command->queryAll();
                
        return ($images);
    }
    
    public function getProductsFilter()
    {
        $query = (new \yii\db\Query())
                ->select('p.id_product,        
                            p.price,
                            p.oldprice,                        
                            cp.id_category,                        
                            pt.id_color,
                            pt.id_size')                
                ->from('Products p')
                ->leftJoin('Categories_Products cp', 'p.id_product = cp.id_product')
                ->leftJoin('Products_Template pt', 'p.id_product = pt.id_product');                
        $command = $query->createCommand();
        $images = $command->queryAll();
                
        return ($images);
    }       
    
//    public function beforeSave($string) 
//    {
//        if ($this->str2url($string))
//        {
//            $this->url = $this->str2url($string);
//            return TRUE;
//        }
//        else 
//            {
//            return FALSE;            
//            }
//    }
//    
//    protected function rus2translit($string) {
//        $converter = array(
//            'а' => 'a',   'б' => 'b',   'в' => 'v',
//            'г' => 'g',   'д' => 'd',   'е' => 'e',
//            'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
//            'и' => 'i',   'й' => 'y',   'к' => 'k',
//            'л' => 'l',   'м' => 'm',   'н' => 'n',
//            'о' => 'o',   'п' => 'p',   'р' => 'r',
//            'с' => 's',   'т' => 't',   'у' => 'u',
//            'ф' => 'f',   'х' => 'h',   'ц' => 'c',
//            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
//            'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
//            'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
//
//            'А' => 'A',   'Б' => 'B',   'В' => 'V',
//            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
//            'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
//            'И' => 'I',   'Й' => 'Y',   'К' => 'K',
//            'Л' => 'L',   'М' => 'M',   'Н' => 'N',
//            'О' => 'O',   'П' => 'P',   'Р' => 'R',
//            'С' => 'S',   'Т' => 'T',   'У' => 'U',
//            'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
//            'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
//            'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
//            'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
//        );
//    return strtr($string, $converter);
//    }
//    
//    protected function str2url($str) {
//        // переводим в транслит
//        $str = $this->rus2translit($str);
//        // в нижний регистр
//        $str = strtolower($str);
//        // заменям все ненужное нам на "-"
//        $str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);
//        // удаляем начальные и конечные '-'
//        $str = trim($str, "-");
//        return $str;
//    }
}
