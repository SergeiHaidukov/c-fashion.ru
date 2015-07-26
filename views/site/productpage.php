<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = $model->name;
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
<div itemscope itemtype="http://schema.org/Product">
<section id="page-title">
    <div class="container clearfix">
        <h1 itemprop="name"><?php echo $model->name ?></h1>
        <a class="btn btn-default btn-lg btn-block" href="/site/contact">Наши контакты</a>
    </div>
</section><!-- #page-title end -->
<section id="content">

            <div class="content-wrap">

                <div class="container clearfix">

                    <div class="postcontent nobottommargin clearfix">

                        <div class="single-product">

                            <div class="product">

                                <div class="col_half">
                                    
                                    <!-- Product Single - Gallery
                                    ============================================= -->
                                    <div class="product-image">
                                        <div class="fslider" data-pagi="false" data-arrows="false" data-thumbs="true">
                                            <div class="flexslider">
                                                <div class="slider-wrap" data-lightbox="gallery">
                                                    <?php
                                                    foreach ($product_images as $key => $primg) {
                                                    ?>                                                            
                                                        <div class="slide" data-thumb="/img/thumbnail/mini/<?php echo $primg['file_name']; ?>"><a href="/img/<?php echo $primg['file_name']; ?>" title="<?php echo $model->name; ?>" data-lightbox="gallery-item"><img itemprop="image" src="/img/<?php echo $primg['file_name']; ?>" alt="<?php echo $model->name; ?>"></a></div>                                                        
                                                    <?php
                                                    }
                                                    ?>                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <?php if(($model->oldprice > 0)&&($model->oldprice != $model->price)){ ?> <div class="sale-flash">Sale!</div> <?php } ?>
                                    </div><!-- Product Single - Gallery End -->
                                </div>
                                    
                                <div class="col_half col_last product-desc">

                                    <!-- Product Single - Price
                                    ============================================= -->
                                    <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                        <div class="product-price"><del><?php if(($model->oldprice > 0)&&($model->oldprice != $model->price)){ echo $model->oldprice; } ?></del> <ins itemprop="price"><?php echo $model->price; ?><span itemprop="priceCurrency"> руб.</span></ins></div><!-- Product Single - Price End -->
                                    </div>

                                    <div class="clear"></div>
                                    <div class="line"></div>
                                    
                                     <!-- Product Single - Short Description
                                    ============================================= -->
                                    <p itemprop="description"><?php echo $model->description; ?></p>
                                    
                                    <div class="clear"></div>
                                    <div class="line"></div>
                                    
                                    <p><strong>По всем вопросам звоните, пожалуйста, по телефону +7-960-885-68-05 Екатерина</strong></p>
                                    <p><strong>Или пишите на email: gorbunova-ekaterina@yandex.ru</strong></p>
                                    
                                    <div class="clear"></div>
                                    <div class="line"></div>
                                    
                                    <h2>Цвета и размеры</h2>
                                    <?php 
                                    foreach ($products_template_array as $key => $pta) {
                                    ?>
                                    <a class="btn btn-default color-product-view btn-sm" style="border-color:<?php echo $pta['color_code']; ?>;" ><?php echo $pta['color_name'].' '.$pta['size_name']?></a>
                                    <?php
                                    }
                                    ?>
                                    
                                </div>                                                                                                
                            </div>
                        </div>
                    </div>
                    <div class="sidebar nobottommargin col_last clearfix">
                        <div class="sidebar-widgets-wrap">

                            <div class="widget widget_links clearfix">
                                
                                <a href="<?php echo (yii\helpers\Url::to(['/catalog/']).'#product_'.$model->id_product); ?>"><h4>Назад</h4></a>
                                
                                <h4>Категории</h4>
                                <ul>
                                    <?php                        
                                    foreach ($categories as $cat) {                          
                                    ?>                    
                                    <li><a class="<?php if($cat['id_category'] == $current_category_id){ echo 'current-sidebar'; } ?>" 
                                       href=<?php echo (yii\helpers\Url::to(['/catalog/'.$cat[translit_name]])); ?> > <?php echo $cat['name']; ?></a></li>
                                    <?php    
                                    //var_dump($current_category_id);                        
                                    }
                                    ?>                     
                                </ul>
                            </div>
                            
                            <div class="widget clearfix">

                                <h4>Новые поступления</h4>
                                <div id="post-list-footer">
                                    <?php 
                                    $count = 0;
                                    foreach ($last_products as $lp)
                                        { 
                                        if($count < 4)
                                        {?>                                    
                                        <div class="spost clearfix">
                                            <div class="entry-image">
                                                <a href=<?php echo (yii\helpers\Url::to(['/dress/'.$lp['id_product']])); ?>><img src="/img/thumbnail/<?php echo $lp['file_name'] ?>" alt="<?php echo $lp['name'] ?>"></a>
                                            </div>
                                            <div class="entry-c">
                                                <div class="entry-title">
                                                    <h4><a href=<?php echo (yii\helpers\Url::to(['/dress/'.$lp['id_product']])); ?>><?php echo $lp['name'] ?></a></h4>
                                                </div>
                                                <ul class="entry-meta">
                                                    <li class="color"><?php echo $lp['price'] ?> руб.</li>
                                                </ul>
                                            </div>
                                        </div>                                    
                                    <?php
                                        }
                                        $count++;
                                        } ?>
                                </div>
                            </div>
                            
                            <div class="widget clearfix">

                                <h4>Популярные товары</h4>
                                <div id="post-list-footer">
                                    <?php                                     
                                    foreach ($popular_products as $lp)
                                        { 
                                        ?>                                    
                                        <div class="spost clearfix">
                                            <div class="entry-image">
                                                <a href=<?php echo (yii\helpers\Url::to(['/dress/'.$lp['id_product']])); ?>><img src="/img/thumbnail/<?php echo $lp['file_name'] ?>" alt="<?php echo $lp['name'] ?>"></a>
                                            </div>
                                            <div class="entry-c">
                                                <div class="entry-title">
                                                    <h4><a href=<?php echo (yii\helpers\Url::to(['/dress/'.$lp['id_product']])); ?>><?php echo $lp['name'] ?></a></h4>
                                                </div>
                                                <ul class="entry-meta">
                                                    <li class="color"><?php echo $lp['price'] ?> руб.</li>
                                                </ul>
                                            </div>
                                        </div>                                    
                                    <?php                                        
                                        } ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
</section>
</div>