<?php
/* @var $this yii\web\View */
//var_dump($products_filter);
?>

        <!-- Page Title
        ============================================= -->
        
        <?php
        $this_category_name = '';
        $this_category_description = '';
        foreach ($categories as $cat) {                                                    
            if($cat['id_category'] == $current_category_id)
                { 
                    $this_category_name = $cat['name']; 
                    $this_category_description = $cat['description'];                    
                } 
            }
            if($this_category_name != '')
            {                        
                $this->title = $this_category_name;
            }
            else {$this_category_name = "Здесь одевают на праздник! Нарядные платья из турецких и итальянских тканей - большой выбор и выгодные цены!";
                    $this->title = $this_category_name;}
        ?>
        <section id="page-title">

            <div class="container clearfix">
                <h1><?php echo $this_category_name; ?></h1>
                <span><?php echo $this_category_description; ?></span>
                <a class="btn btn-default btn-lg btn-block" href="/site/contact">Наши контакты</a>
            </div>

        </section><!-- #page-title end -->
<div id="top"></div>
        <section id="content">

            <div class="content-wrap">

                <div class="container clearfix">
                    
                    <!-- Post Content
                    ============================================= -->
                    <div class="postcontent nobottommargin">

                        <!-- Shop
                        ============================================= -->
                        <div id="shop" class="product-3 clearfix">                           
                            <?php
                            if(!empty($products)){ foreach ($products as $pr) {
                            ?>                                  
                            <div class="product clearfix">
                                <div id="product_<?php echo $pr[0]['id_product']; ?>"></div>
                                <div class="product-image">
                                    <?php 
                                    $count_miniatures = 0;
                                    foreach ($pr as $pr_single){ 
                                        $count_miniatures++;
                                    }
                                    
                                    if($count_miniatures >= 3)
                                    {
                                    ?>
                                    <div class="fslider" data-arrows="false">
                                        <div class="flexslider">
                                            <div class="slider-wrap">
                                                <?php foreach ($pr as $pr_single){ ?>
                                                <div class="slide"><a href=<?php echo (yii\helpers\Url::to(['/dress/'.$pr_single['id_product']])); ?> ><img src="/img/thumbnail/<?php echo $pr_single['file_name'];  ?>" alt="<?php echo $pr_single['description'];  ?>"></a></div>
                                                <?php } ?>                                                
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                    } 
                                    else
                                    { ?>
                                    <?php foreach ($pr as $pr_single){ ?>
                                    <a href=<?php echo (yii\helpers\Url::to(['/dress/'.$pr_single['id_product']])); ?> ><img src="/img/thumbnail/<?php echo $pr_single['file_name'];  ?>" alt="<?php echo $pr_single['description'];  ?>"></a>
                                    <?php } 
                                    }
                                    ?>                                                                        
                                    
                                    <?php if(($pr[0]["oldprice"] > 0)&&($pr[0]["oldprice"] != $pr[0]["price"])){ ?> <div class="sale-flash">Sale!</div> <?php } ?>
                                </div>
                                <div class="product-desc center">
                                   <div class="product-price"><del><?php if(($pr[0]["oldprice"] > 0)&&($pr[0]["oldprice"] != $pr[0]["price"])){ ?> <?php echo $pr[0]["oldprice"]; ?> <?php } ?></del> <ins> <?php echo $pr[0]["price"];  ?> руб.</ins></div>
                                </div>

                            </div>
                                <?php    
                                }}
                                else { echo '<h3>К сожалению по вашему запросу ничего не найдено</h3>'; }
                                ?>
                            
                        </div> 
                    </div>                    
                    
                    <!-- Sidebar
                    ============================================= -->
                    <div class="sidebar nobottommargin col_last">
                        <div class="sidebar-widgets-wrap">

                            <div class="widget widget_links clearfix">
                                
                                <a href="/site/clearsessionparam"><h4>Показать все платья</h4></a>
                                
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
                                
                                <h4>Размеры</h4>
                                <ul>                                    
                                    <?php
                                    foreach ($sizes as $sz) {
                                        $check_size = 0;
                                        if(is_array($current_sizes_id))
                                        {
                                            foreach ($current_sizes_id as $currsize)
                                            {    
                                                if($sz['id_size'] == $currsize)
                                                {
                                                    $check_size = 1;
                                                }
                                            }
                                        }
                                        //$buil_url_array = $products_model->builUrl('sizes', $sz['id_size']);
                                    ?>
                                    <li><a class="<?php if($check_size == 1){ echo 'current-sidebar'; } ?> " href=<?php echo (yii\helpers\Url::toRoute(['site/setsessionparam', 'param_name'=>'sizes', 'param_value'=> $sz['id_size']])); //echo $buil_url_array['url']; ?>><?php echo $sz['size_name']; ?></a></li>
                                    <?php                        
                                    }
                                    ?>
                                </ul>
                                
                                <h4>Цвета</h4>
                                <ul>                                    
                                    <?php
                                    foreach ($colors as $col) {
                                        $check_color = 0;
                                        if(is_array($current_colors_id))
                                        {
                                            foreach ($current_colors_id as $currcol)
                                            {    
                                                if($col['id_color'] == $currcol)
                                                {
                                                    $check_color = 1;
                                                }
                                            }
                                        }
                                        //$buil_url_array = $products_model->builUrl('colors', $col['id_color']);
                                    ?>
                                    <li><a class="<?php if($check_color == 1){ echo 'current-sidebar'; } ?>" href=<?php echo (yii\helpers\Url::toRoute(['site/setsessionparam', 'param_name'=>'colors', 'param_value'=> $col['id_color']])); //echo $buil_url_array['url']; ?>><?php echo $col['color_name']; ?></a></li>
                                    <?php    
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
                                                <a href=<?php echo (yii\helpers\Url::to(['/dress/'.$lp[0]['id_product']])); ?>><img src="/img/thumbnail/<?php echo $lp[0]['file_name'] ?>" alt="<?php echo $lp[0]['description'] ?>"></a>
                                            </div>
                                            <div class="entry-c">
                                                <div class="entry-title">
                                                    <h4><a href=<?php echo (yii\helpers\Url::to(['/dress/'.$lp[0]['id_product']])); ?>><?php echo $lp[0]['name'] ?></a></h4>
                                                </div>
                                                <ul class="entry-meta">
                                                    <li class="color"><?php echo $lp[0]['price'] ?> руб.</li>
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

    
<!--<div ng-app="cfashion">
    <div class="site-index">        
        <div ng-view [onload=""] [autoscroll=""]></div>                
        <div class="container">
            <div class="row">
                <div class="main-showcase jumbotron">
                    <h1>Заманушная картинка</h1>
                </div>
                <div class="col-md-12 evening-dresses jumbotron">                
                        <h1>ВЕЧЕРНИЕ ПЛАТЬЯ</h1>                
                </div>
                <div class="col-md-12 coctail-dresses jumbotron">               
                        <h1>КОТЕЙЛЬНЫЕ ПЛАТЬЯ</h1>                
                </div>
                <div class="col-md-12 casual-dresses jumbotron">                
                        <h1>ПОВСЕДНЕВНЫЕ ПЛАТЬЯ</h1>                
                </div>
            </div>
        </div>
    </div>
</div>-->

