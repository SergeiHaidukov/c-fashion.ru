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
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <?= Html::csrfMetaTags() ?>    
    <?php// $this->title = 'Здесь одевают на праздник! Нарядные платья из турецких и итальянских тканей - большой выбор и выгодные цены!' ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="stretched">

<?php $this->beginBody() ?>
    <div id="wrapper" class="clearfix">
        
        <header id="header" class="full-header">

            <div id="header-wrap">

                <div class="container clearfix">

                    <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>
                    
                    <!-- Logo
                    ============================================= -->
                    <div id="logo">
                        <a href="<?php echo (yii\helpers\Url::to(['/catalog/'])); ?>" class="standard-logo" data-dark-logo="/images/logo-dark.png"><img src="/images/logo.png" alt="c-fashion.ru"></a>                        
                    </div><!-- #logo end -->
                    
                    <nav id="primary-menu">

                        <ul>
                            <?php
                            if (!Yii::$app->user->isGuest)
                            {?>
                            <li><a href="#"><div>Администрирование</div></a>
                                <ul>
                                    <li><a href="/products"><div>Платья</div></a></li>                                        
                                </ul>
                            </li> 
                            <?php    
                            }
                            ?>
                            <li>
                                <a href=<?php echo (yii\helpers\Url::to(['/catalog/'])); ?>><div>Каталог платьев</div></a>
                            </li> 
                            <li>
                                <a href="/site/contact"><div>Наши контакты</div></a>
                            </li>                            
                        </ul>
                    </nav>    
                    
                </div>    
            </div>
        </header>             
        <?php
      /*  if (!Yii::$app->user->isGuest)
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
        }    */
        ?>

        <?= $content ?>
    
        
    </div>

<!-- Yandex.Metrika counter --><script type="text/javascript">(function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter28531641 = new Ya.Metrika({id:28531641, webvisor:true, clickmap:true, accurateTrackBounce:true}); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="//mc.yandex.ru/watch/28531641" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
