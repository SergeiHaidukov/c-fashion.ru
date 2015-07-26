<?php

        <!--<a href="/site/kupon" class="sale-button btn btn-danger"> >>> Получить скидку <<< </a>-->
        <div class="">           
            <?php $products_model = new \app\models\Products(); ?>
            <a href="<?php echo (yii\helpers\Url::to(['/catalog/'])); //echo $products_model->builUrl('back_home', '1')['url']; ?>" ><img src="/images/design/logo.jpg" alt="" class="img-responsive header-logo"></a>
<!--            <div class="row">
                <div class="col-xs-12 text-center">
                    <h2>Мы хотим выбрать для Вас лучшее вечернее платье.</h2>
                </div>
            </div>-->
        </div>
        <div class="container">
            <div class="row header-menu">
                <div class="">                       
                    <a class="btn btn-default col-xs-6" href=<?php echo (yii\helpers\Url::to(['/catalog/'])); //echo $products_model->builUrl('back_home', '1')['url']; ?>>Каталог платьев</a>
                    <a class="btn btn-default col-xs-6" href="/site/contact" onclick="yaCounter28531641.reachGoal('contact_watch'); return true;">Наши контакты</a>
                </div>
            </div>            
        </div>
        <div class="container">
            <div class="row header-text text-justify text-primary">                
                <h3><em>Здесь одевают на праздник! Нарядные платья из турецких и итальянских тканей - большой выбор и выгодные цены!</em></h3>
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
                            <a href=<?php echo (yii\helpers\Url::to(['/dress/'.$pr['id_product']]));  // echo $products_model->builUrl('id_product', $pr['id_product'])['url']; ?> ><img src="/img/thumbnail/<?php echo $pr["file_name"];  ?>" class="img-responsive img-rounded list-img-thumbnail col-xs-12"></a>
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

