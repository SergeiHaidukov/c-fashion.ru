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
    <title>Мы хотим выбрать для Вас лучшее вечернее платье.</title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">        
        <div class="container">            
            <div class="row">
                <div class="col-xs-12 text-center">
                    <h2>Мы хотим выбрать для Вас лучшее вечернее платье.</h2>
                </div>
            </div>
            <div class="row">                
                <div class="col-xs-12">                      
                    <a class="btn btn-default col-xs-6" href="/#!/list">Выбрать платье</a>
                    <a class="btn btn-default col-xs-6" href="/#!/contact">Наши контакты</a>
                </div>
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
                        ],
                    ],
                ],
                ]);
            }
            NavBar::end();
        }    
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>        
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
