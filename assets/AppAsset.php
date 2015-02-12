<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [        
        'js/angular-material.min.css',
        'css/site.css',
    ];
    public $js = [
        'js/angular.min.js',
        'js/ui-bootstrap-tpls-0.12.0.min.js',
        'js/app.js',        
        'js/controllers/ProductsController.js',
        'js/services/PoductsService.js',
        'js/controllers/CategoriesController.js',
        'js/services/CategoriesService.js',
        'js/angular-cookies.min.js',
        'js/angular-route.min.js',        
        '//cdn.jsdelivr.net/hammerjs/2.0.4/hammer.min.js',
        '//ajax.googleapis.com/ajax/libs/angularjs/1.3.6/angular-animate.min.js',
        '//ajax.googleapis.com/ajax/libs/angularjs/1.3.6/angular-aria.min.js',
        'js/angular-material.min.js',
        'js/bootstrap/dist/js/bootstrap.min.js',
        'js/bootstrap/js/tab.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
