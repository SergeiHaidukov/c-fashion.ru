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
    private $products_filter = array();
    private $products_miniature = array();
    private $popular_products = array();    

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
            [['isview', 'views_count'], 'integer'],
            [['description'], 'string'],
            [['create_date', 'last_update'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['url'], 'string', 'max' => 255]
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
            'create_date' => 'Create Date',
            'last_update' => 'Last Update',
            'views_count' => 'Views Count',
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
        if(empty($this->products_miniature))
        {
            $query = (new \yii\db\Query())
                ->select('*')
                ->where(['>=', 'pp.is_miniature', 1/*, 'p.isview' => 1*/ ])
                ->from('Products p')
                ->leftJoin('Pictures_Products pp', 'p.id_product = pp.id_product')
                ->leftJoin('Pictures p1', 'pp.id_picture = p1.id_picture')
                ->orderBy('p.id_product DESC');
            $command = $query->createCommand();            
            $products_miniature_tmp = $command->queryAll();
            
            
            $products_miniature = array();
            $id_product_prev = $products_miniature_tmp[0]['id_product'];
            $one_product_miniatures = array();
            
            foreach ($products_miniature_tmp as $pmt)
            {                
                $id_product = $pmt['id_product'];
                if($id_product == $id_product_prev)
                {
                    array_push($one_product_miniatures, $pmt);
                }
                else 
                {
                    $id_product_prev = $id_product;
                    array_push($products_miniature, $one_product_miniatures);
                    $one_product_miniatures = array();
                    array_push($one_product_miniatures, $pmt);
                }
            }
            //var_dump($products_miniature);
            $this->products_miniature = $products_miniature;
        }
                
        return ($this->products_miniature);
    }
    
    public function getPopularProducts()
    {     
        if(empty($this->popular_products))
        {
            $query = (new \yii\db\Query())
                ->select('*')
                ->where(['pp.is_miniature' => 1/*, 'p.isview' => 1*/ ])
                ->from('Products p')
                ->leftJoin('Pictures_Products pp', 'p.id_product = pp.id_product')
                ->leftJoin('Pictures p1', 'pp.id_picture = p1.id_picture')
                ->orderBy('p.views_count DESC')
                ->limit('4');
            $command = $query->createCommand();
            $this->popular_products = $command->queryAll();            
        }
        
        return ($this->popular_products);
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
    
    public function getFilteredProducts() 
    {                
//        if (empty($this->products_filter))
//            {
//               $this->products_filter = $this->getProductsFilter();
//            }
        
//        $filtered_products = $this->products_filter;
        $filtered_products_tmp = array();
          
            $query = (new \yii\db\Query())
            ->select('p.id_product,
                        p.price,
                        p.oldprice,                        
                        cp.id_category,                        
                        pt.id_color,
                        pt.id_size')
            ->from('Products p')
//                    ->where(['pt.id_color' => $colors, 'cp.id_category' => $category])
            ->leftJoin('Categories_Products cp', 'p.id_product = cp.id_product')
            ->leftJoin('Products_Template pt', 'p.id_product = pt.id_product');
//            ->select('*')
//            ->from('productwithfilters');
            
            
            $session = \Yii::$app->session;
            
            //if($query_param['colors'] != '') { $colors = explode(",", $query_param['colors']); $query->andWhere(['pt.id_color' => $colors]); }
            //if($query_param['category'] != '') { $category = explode(",", $query_param['category']); $query->andWhere(['cp.id_category' => $category]); }
            //if($query_param['sizes'] != '') { $sizes = explode(",", $query_param['sizes']); $query->andWhere(['pt.id_size' => $sizes]); }

            if($session->get('category') != null) { $category = $session->get('category'); $query->andWhere(['cp.id_category' => $category]); }            
            
            $sizes = $session->get('sizes');
            if($this->arrayIsNull($sizes)) { $query->andWhere(['pt.id_size' => $sizes]); }
            
            $colors = $session->get('colors');
            if($this->arrayIsNull($colors)) { $query->andWhere(['pt.id_color' => $colors]); }
            
            $command = $query->createCommand();
            //var_dump($command);
            $filtered_products_tmp = $command->queryAll();             
        
        $products_miniature = $this->getProductsMiniture();
        //var_dump($filtered_products_tmp);
        
        if(!empty($filtered_products_tmp))
        {
            foreach($products_miniature as $key => $pm)
            {
                //var_dump($key);
                $count = 0;
                foreach($filtered_products_tmp as $fp)
                {
                    if($pm[0]['id_product'] == $fp['id_product'])
                    {
                        $count++;
                        //unset($array2[$key]);
                    }
                }
                if($count == 0){unset($products_miniature[$key]);}
            }
        }
        else { $products_miniature = array(); }
        
        //var_dump($products_miniature);
//        $products_miniature = $this->getProductsMiniture();
//        
//        
//        if(!empty($filtered_products_tmp))
//        {
//            foreach($products_miniature as $key => $pm)
//            {
//                //var_dump($key);
//                $count = 0;
//                foreach($filtered_products_tmp as $fp)
//                {
//                    if($pm['id_product'] == $fp['id_product'])
//                    {
//                        $count = $count + 1;
//                        //unset($array2[$key]);
//                    }
//                }
//                if($count == 0){unset($products_miniature[$key]);}
//            }
//        }
//                
//        if(!empty($filtered_products_tmp))
//        {            
//            return $filtered_products_tmp;
//        }
//        else { return $filtered_products; }
        
        return $products_miniature;
    }
    
    public function arrayIsNull($array)
    {
        if(is_array($array))
        {
            $result = FALSE;
            foreach ($array as $ar)
            {
                if($ar != NULL){ $result = TRUE; }
            }
        }
        return $result;
    }
    
    public function builUrl($param_name, $param_value)
    {
        parse_str($_SERVER['QUERY_STRING'], $query_param);        
        $query_param_array = array();
        $count = 0;
        
//        if($param_name == 'category')
//        {
//            $query_param_array['category'] = array();
//        }
//        else { $query_param_array['category'] = explode(",", $query_param['category']); }        
        $session = \Yii::$app->session;
        
        $query_param_array['category'] = explode(",", $query_param['category']);
        $query_param_array['colors'] = explode(",", $query_param['colors']);
        $query_param_array['sizes'] = explode(",", $query_param['sizes']);
        $query_param_array['product_main_photo'] = explode(",", $query_param['product_main_photo']);
        $query_param_array['id_product'] = explode(",", $query_param['id_product']);
        
        //$query_param_array['category'] = explode(",", $session->get('category'));
                
        if($param_name == 'back_home')
        {
            $query_param_array['id_product'] = array();
            $query_param_array['product_main_photo'] = array();
        }
        
        if($param_name != 'back_home')
        {
            foreach ($query_param_array[$param_name] as $key => $value) {
                if ($value == $param_value)
                {
                    $count++;
                    unset($query_param_array[$param_name][$key]);
                }
            }
            if ($count == 0)
            {
                if(($param_name == 'category')||($param_name == 'product_main_photo')||($param_name == 'id_product'))
                {
                    $query_param_array[$param_name] = array();              
                }
                array_push($query_param_array[$param_name], $param_value);
            }
        }
        $buil_url = '';
        foreach ($query_param_array as $key => $qpv) {            
            $qpv_string = implode(",", $qpv);
            //var_dump($qpv);
//            var_dump(htmlentities($output)); 
//            $qpv_string = '';
//            foreach ($qpv as $qpv_value) {
//                if($qpv_string == '')
//                {
//                    $qpv_string = $qpv_value;
//                }
//                else 
//                {
//                    $qpv_string = $qpv_string.$qpv_value.",";
//                }
//            }

            if ($qpv_string != '')
            {                
                if($buil_url != '')
                {
                    $buil_url = $buil_url."&".$key."=".$qpv_string;
                }
                else 
                {
                    $buil_url = $key."=".$qpv_string;
                }
            }
        }
        //var_dump(\yii\helpers\Url::home().'index.php?'.$buil_url);
        switch ($param_name)
        {
            case 'id_product' : $base_url = '/site/productpage'; break;
            case 'back_home' : $base_url = '/index.php'; $hash_text = "#product_".$query_param['id_product']; break;
            case 'product_main_photo' : $hash_text = "#main_photo"; break;
            case 'category' : $hash_text = "#top"; break;
            case 'sizes' : $hash_text = "#top"; break;
            case 'colors' : $hash_text = "#top"; break;
            default : $base_url = parse_url(\yii\helpers\Url::to())['path']; break;
        }        
        
//        if($param_name == 'id_product')
//        {
//            $base_url = 'site/productpage';           
//        }
//        else
//        {
//            $base_url = parse_url(\yii\helpers\Url::to())['path'];
//        }
        
        
        
        $buil_url_array = array('url' => $base_url.'?'.$buil_url.$hash_text , 'is_url_param' => $count);
        
        //var_dump($buil_url_array);
        
        return $buil_url_array;
        
        //var_dump(\yii\helpers\Url::to(['/index.php', $buil_url]));
    }
            
    private function clearArray()
    {
        $clear_array = array();
        
    }
    
    public function viewsCountUp()
    {                
        $this->views_count = $this->views_count + 1;                
        $this->save();
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
