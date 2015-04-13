<?php
/* @var $this yii\web\View */
$this->title = 'Магазин "Contrast fashion"';

//var_dump($products_filter);
?>

    <div class="row">
        <div class="col-md-3 col-sm-3 col-sm-push-9 sidemenu">
            <div class="row">
                <a class="btn btn-danger cat-set-button col-xs-12" href="/index.php" >Очистить фильтры</a>
                <div class="col-xs-12">
                    <h4>Категории</h4>
                    <div class="">
                        <?php
                        $this_category_name = '';
                        foreach ($categories as $cat) {
                          $buil_url_array = $products_model->builUrl('category', $cat['id_category']);
                        ?>                    
                        <a class="btn btn-default cat-set-button col-xs-12" href=<?php echo $buil_url_array['url']; ?> > <?php echo $cat['name']; ?><?php if($buil_url_array['is_url_param'] > 0){ $this_category_name = $cat['name']; ?> <i class="glyphicon glyphicon-ok"></i> <?php } ?></a>                    
                        <?php    
                        }
                        ?>                    
                    </div>
                </div>
                <div class="col-xs-12">
                    <h4>Размеры</h4>
                    <?php
                    foreach ($sizes as $sz) {
                        $buil_url_array = $products_model->builUrl('sizes', $sz['id_size']);
                    ?>
                        <a class="btn btn-default sizes-set-button" href=<?php echo $buil_url_array['url']; ?>><?php echo $sz['size_name']; ?><?php if($buil_url_array['is_url_param'] > 0){ ?> <i class="glyphicon glyphicon-ok"></i> <?php } ?></a>
                    <?php    
                    }
                    ?>
                </div>
                <div class="col-xs-12">
                    <h4>Цвета</h4>
                    <?php
                    foreach ($colors as $col) {
                        $buil_url_array = $products_model->builUrl('colors', $col['id_color']);
                    ?>
                        <a class="btn btn-default color-set-button" style="border-color:<?php echo $col['color_code'] ?>;" href=<?php echo $buil_url_array['url']; ?>><?php echo $col['color_name']; ?><?php if($buil_url_array['is_url_param'] > 0){ ?> <i class="glyphicon glyphicon-ok"></i> <?php } ?></a>
                    <?php    
                    }
                    ?>
                </div>
            </div>
        </div>
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
                        <span class="col-xs-12 text-center">Цена: <?php echo $pr["price"];  ?> руб.</span>
                            <!--<a class="btn btn-info btn-xs product-view" href="/#!/page/{{p.id_product}}">Смотреть</a>-->
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

