<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>    
    <?php// $this->title = 'Здесь одевают на праздник! Нарядные платья из турецких и итальянских тканей - большой выбор и выгодные цены!' ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">                    
        <!--<a href="/site/kupon" class="sale-button btn btn-danger"> >>> Получить скидку <<< </a>-->
        <div class="">           
            <?php $products_model = new \app\models\Products(); ?>
            <a href="<?php echo $products_model->builUrl('back_home', '1')['url']; ?>" ><img src="/images/design/logo.jpg" alt="" class="img-responsive header-logo"></a>
<!--            <div class="row">
                <div class="col-xs-12 text-center">
                    <h2>Мы хотим выбрать для Вас лучшее вечернее платье.</h2>
                </div>
            </div>-->
        </div>
        <div class="container">
            <div class="row header-menu">
                <div class="">                       
                    <a class="btn btn-default col-xs-6" href=<?php echo $products_model->builUrl('back_home', '1')['url']; ?>>Каталог платьев</a>
                    <a class="btn btn-default col-xs-6" href="/site/contact" onclick="yaCounter28531641.reachGoal('contact_watch'); return true;">Наши контакты</a>
                </div>
            </div>            
        </div>
        <div class="container">
            <div class="row header-text text-justify text-primary">                
                <h3><em>Здесь одевают на праздник! Нарядные платья из турецких и итальянских тканей - большой выбор и выгодные цены!</em></h3>
            </div>
        </div>    
        

        <?php
        if (!Yii::$app->user->isGuest)
        {
            NavBar::begin([
                'brandLabel' => 'C-Fashion',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Home', 'url' => ['/site/index']],
                    ['label' => 'About', 'url' => ['/site/about']],
                    ['label' => 'Contact', 'url' => ['/site/contact']],
                    ['label' => 'ProductPage', 'url' => ['/site/productpage']],
                    ['label' => 'ProductsList', 'url' => ['/site/productslist']],                                        
                    Yii::$app->user->isGuest ?
                        ['label' => 'Login', 'url' => ['/site/login']] :
                        ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                ],
            ]);
            if (YII::$app->user->can('dashboard')){  
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => [
                    [
                        'label' => 'Администрирование',                        
                        'items' => [
                             ['label' => 'Категории', 'url' => '/categories'],
                             ['label' => 'Платья', 'url' => '/products'],
                             ['label' => 'Цвета', 'url' => '/colors'],
                             ['label' => 'Размеры', 'url' => '/sizes'],
                             ['label' => 'Свойства продукта', 'url' => '/product-attribute-template'],
                             ['label' => 'Значение свойств продукта', 'url' => '/product-attribute-value'],
                        ],
                    ],
                ],
                ]);
            }
            NavBar::end();
        }    
        ?>

        <div class="container">            
            <?= $content ?>
            <!--<div class="container fixed-footer">
            
            </div>-->
        </div>
        
    </div>

<!-- Yandex.Metrika counter --><script type="text/javascript">(function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter28531641 = new Ya.Metrika({id:28531641, webvisor:true, clickmap:true, accurateTrackBounce:true}); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="//mc.yandex.ru/watch/28531641" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
