<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
//$this->title = 'Product Page';
//$this->params['breadcrumbs'][] = $this->title;
//echo \yii\widgets\Breadcrumbs::widget([    
//    'links' => [
//        [
//            'label' => 'Products List',
//            'url' => ['/site/productslist'],            
//        ],        
//        ['label' => 'Product Page']
//    ],
//]);
?>
<a class="btn btn-info col-xs-12" href=<?php echo $products_model->builUrl('back_home', '1')['url']; ?>><h3>Назад</h3></a>
<div itemscope itemtype="http://schema.org/Product">
    <div class="row productpage">
        <div class="col-xs-12 productpage-text">
            
                <div class="col-xs-6 text-center">
                    <h1 itemprop="name"><?php echo $model->name; ?></h1>
                </div>
                <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                    <div class="col-xs-6 text-center">
                        <h2>Цена: <span itemprop="price"><?php echo $model->price; ?></span> <span itemprop="priceCurrency">RUB</span></h2>
                            
                    </div>
                </div>
            
            
                <div class="col-xs-12 text-center">
                    <h4 itemprop="description" <?php echo $model->description; ?>></h4>
                </div>
            
            
                <div class="col-xs-12 phone_number text-center">
                    <h3>По всем вопросам звоните, пожалуйста, по телефону <strong>+7-960-885-68-05</strong> Екатерина</h3>
                    <h3>Или пишите на email: gorbunova-ekaterina@yandex.ru</h3>
                </div>
            
        </div>
        <div class="col-xs-12 productpage-foto">            
            <div class="col-sm-8 product-foto-main">
                <?php  ?>
                <img itemprop="image" src="/img/<?php if($main_photo_name == '') { echo $product_images[0]['file_name']; } else { echo $main_photo_name; } ?>" alt="" class="img-responsive img-rounded col-xs-12">
            </div>
            <div class="col-sm-4">
                <?php
                foreach ($product_images as $key => $primg) {
                ?>
                    <div class="col-xs-6 col-sm-12 thumbnail-btn">
                        <a href=<?php echo $products_model->builUrl('product_main_photo', $primg['file_name'])['url'];?>><img itemprop="image" src="/img/thumbnail/<?php echo $primg['file_name']; ?>" alt="" class="btn img-responsive img-rounded col-xs-12"></a>
                    </div>
                <?php
                }
                ?>
                <div ng-repeat="pp in single_product_images">
                    <div class="col-xs-6 col-sm-12 thumbnail-btn">
                        <img itemprop="image" src="/img/thumbnail/{{pp.file_name}}" alt="" class="btn img-responsive img-rounded col-xs-12" ng-click="setmainpictures(pp.id_picture)">
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>
