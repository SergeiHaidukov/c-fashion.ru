<?php
/* @var $this yii\web\View */
$this->title = "131231231";// $this_category_name;

//var_dump($products_filter);
?>
    <div class="row">
        <div class="col-md-3 col-sm-3 col-sm-push-9 sidemenu">
            <div class="row">
                <a class="btn btn-danger cat-set-button col-xs-12" href=<?php echo (yii\helpers\Url::toRoute(['site/clearsessionparam'])); ?>> <!--"/index.php"-->Показать все платья</a>
                <div class="col-xs-12">
                    <h4>Категории</h4>
                    <div class="">
                        <?php
                        $this_category_name = '';
                        foreach ($categories as $cat) {                          
                        ?>                    
                        <a class="btn btn-default cat-set-button col-xs-12 <?php if($cat['id_category'] == $current_category_id){ echo 'btn-warning'; } ?>" 
                           href=<?php echo (yii\helpers\Url::to(['/'.$cat[translit_name]])); // echo $buil_url_array['url']; ?> > <?php echo $cat['name']; ?><?php if($cat['id_category'] == $current_category_id){ $this_category_name = $cat['name']; ?> <i class="glyphicon glyphicon-ok"></i> <?php } ?></a>
                        <?php    
                        //var_dump($current_category_id);
                        if($this_category_name != '')
                        {                        
                            $this->title = $this_category_name;
                        }
                        else {$this->title = "Здесь одевают на праздник! Нарядные платья из турецких и итальянских тканей - большой выбор и выгодные цены!";}
                        }
                        ?>                    
                    </div>
                </div>
                <div class="col-xs-12">
                    <h4>Размеры</h4>
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
                        <a class="btn btn-default sizes-set-button <?php if($check_size == 1){ echo 'btn-warning'; } ?> " href=<?php echo (yii\helpers\Url::toRoute(['site/setsessionparam', 'param_name'=>'sizes', 'param_value'=> $sz['id_size']])); //echo $buil_url_array['url']; ?>><?php echo $sz['size_name']; ?><?php if($check_size == 1){ ?> <i class="glyphicon glyphicon-ok"></i> <?php } ?></a>
                    <?php                        
                    }
                    ?>
                </div>
                <div class="col-xs-12">
                    <h4>Цвета</h4>
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
                        <a class="btn btn-default color-set-button <?php if($check_color == 1){ echo 'btn-warning'; } ?>" style="border-color:<?php echo $col['color_code'] ?>;" href=<?php echo (yii\helpers\Url::toRoute(['site/setsessionparam', 'param_name'=>'colors', 'param_value'=> $col['id_color']])); //echo $buil_url_array['url']; ?>><?php echo $col['color_name']; ?><?php if($check_color == 1){ ?> <i class="glyphicon glyphicon-ok"></i> <?php } ?></a>
                    <?php    
                    }
                    ?>
                </div>
            </div>
        </div>
        <div id="top"></div>
        <div class="col-md-9 col-sm-9 col-sm-pull-3 productslist">
            <div class="row text-center"><h1><?php echo $this_category_name; ?> </h1></div>
            <?php
            if(!empty($products)){ foreach ($products as $pr) {
            ?>                    
                    <div class="col-md-4 col-sm-6 col-xs-12 singleproduct">
                        <div id="product_<?php echo $pr['id_product'] ?>"></div>
                        <div class="product-miniature" href="">
                            <a href=<?php echo $products_model->builUrl('id_product', $pr['id_product'])['url']; ?> ><img src="/img/thumbnail/<?php echo $pr["file_name"];  ?>" class="img-responsive img-rounded list-img-thumbnail col-xs-12"></a>
                        </div>
                        <span class="col-xs-12 text-center">                            
                            <span class="">Цена:<?php if(($pr["oldprice"] > 0)&&($pr["oldprice"] != $pr["price"])){ ?>  <span class="old-price-text"><strike><?php echo $pr["oldprice"];  ?></strike></span><?php } ?>  <?php echo $pr["price"];  ?> руб.</span>                        
                            <!--<a class="btn btn-info btn-xs product-view" href="/#!/page/{{p.id_product}}">Смотреть</a>-->
                        </span>
                    </div>        

            <?php    
            }}
            else { echo '<h3>К сожалению по вашему запросу ничего не найдено</h3>'; }
            ?>
        </div>
    </div>

    
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

