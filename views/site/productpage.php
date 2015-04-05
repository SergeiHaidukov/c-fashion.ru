<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
//$this->title = 'Product Page';
//$this->params['breadcrumbs'][] = $this->title;
echo \yii\widgets\Breadcrumbs::widget([    
    'links' => [
        [
            'label' => 'Products List',
            'url' => ['/site/productslist'],            
        ],        
        ['label' => 'Product Page']
    ],
]);
?>
<div itemscope itemtype="http://schema.org/Product">
<div class="container">
    <div class="row productpage">
        <div class="col-xs-12 productpage-text">
            <div class="row">
                <div class="col-xs-6 text-center">
                    <h1 itemprop="name"><?php echo $model->name; ?></h1>
                </div>
                <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                    <div class="col-xs-6 text-center">
                        <h2>Цена: <span itemprop="price"><?php echo $model->price; ?></span> <span itemprop="priceCurrency">RUB</span></h2>
                            
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 text-center">
                    <h4 itemprop="description" ng-bind-html="sce.trustAsHtml(single_product.description)"></h4>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 phone_number text-center">
                    <h3>По всем вопросам звоните, пожалуйста, по телефону <strong>+7-960-885-68-05</strong> Екатерина</h3>
                    <h3>Или пишите на email: gorbunova-ekaterina@yandex.ru</h3>
                </div>
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
        
        <div class="col-md-7 productpage-foto">
                <div class="row product-foto-main">
                    <?php
                    $files = $model->getImage($model->id_product);
                    var_dump($files);
                    $filename = $files[0];
                    ?>
                    <img src="<?php echo (yii\helpers\Url::to('@web/img/'.$filename['file_name'], true)); ?>" class="img-responsive" >
                </div>
                <div class="row">        
                    <?php                    
                     foreach ($files as $filename)
                     {?>
                      <div class="col-md-3">
                        <div class="thumbnail">
                          <img src= "<?php echo (yii\helpers\Url::to('@web/img/thumbnail/'.$filename['file_name'], true)); ?>" class="img-responsive">
                          <!--<div class="caption">
                            <h6><?php// echo ($filename['file_name']) ?></h6>          
                            <p><a href=<?php// echo (yii\helpers\Url::toRoute(['products/delpicprod', 'id_product'=>$model->id_product, 'id_picture'=> $filename['id_picture']])) ?> class="btn btn-danger btn-xs" role="button">Удалить</a></p>
                          </div>-->
                        </div>
                      </div>
                    <?php 
                     }
                    ?>                              
                </div>
        </div>
        <div class="col-md-5 productpage-text maket">
            
        </div>
    </div>
</div>
</div>
