<?php
/* @var $this yii\web\View */
$this->title = 'Магазин "Contrast fashion"';

//var_dump($products_filter);
?>
<div class="container">
<div class="row">
    <div class="col-md-3 col-sm-3 col-sm-push-9 sidemenu">
        
    </div>
        <div class="col-md-9 col-sm-9 col-sm-pull-3 productslist">
<?php
foreach ($products as $pr) {
?>
    
        <div class="col-md-4 col-sm-6 col-xs-12 singleproduct">            
            <a class="product-miniature" href="">
                <img src="/img/thumbnail/<?php echo $pr["file_name"];  ?>" class="img-responsive img-rounded list-img-thumbnail col-xs-12">
            </a>
            <span class="col-xs-12 text-center">Цена: <?php echo $pr["price"];  ?> руб.</span>
                <!--<a class="btn btn-info btn-xs product-view" href="/#!/page/{{p.id_product}}">Смотреть</a>-->
        </div>        
    
<?php    
}
?>
        </div>
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

