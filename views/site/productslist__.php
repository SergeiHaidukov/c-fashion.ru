<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'Products List';
$this->params['breadcrumbs'][] = $this->title;
?>
<div ng-app="cfashion">
    <div ng-controller="ProductsController">            
        <div class="container">           
            <div class="row">                        
                <div ng-repeat="cf in categories_filter">  
                    <a class="btn btn-default cat-set-button" ng-click="delfiltercatprod(cf.id_category)" >{{cf.name}} <i class="glyphicon glyphicon-remove"></i></a>
                </div>                        
                <div ng-repeat="sf in sizes_filter">
                    <a class="btn btn-default sizes-set-button" ng-click="delfiltersizeprod(sf.id_size)" >{{sf.name}} <i class="glyphicon glyphicon-remove"></i></a>
                </div>
                <div ng-repeat="colf in colors_filter">
                    <a class="btn btn-default color-set-button" ng-click="delfiltercolorprod(colf.id_color)" ng-style="{'border-color':colf.code}" >{{colf.name}} <i class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>            
            <div class="row">            
                <div class="col-md-3 col-sm-3 sidemenu">                    
                    <div class="row">                        
                        <div class="col-xs-12">
                            <h4>Категории</h4>                            
                            <div class="row">
                                <div ng-repeat="c in categories | orderBy : 'name'">
                                    <a class="btn btn-default cat-set-button" ng-click="setfiltercatprod(c.id_category)">{{c.name}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <h4>Цена</h4>
                            <p>...</p>
                        </div>
                        <div class="col-xs-12">
                            <h4>Размеры</h4>
                            <div class="row">            
                                <div ng-repeat="sz in sizes | orderBy : 'name'">
                                    <a class="btn btn-default sizes-set-button" ng-click="setfiltersizeprod(sz.id_size)">{{sz.name}}</a>
                                </div>
                            </div>                            
                        </div>
                        <div class="col-xs-12">
                            <h4>Цвета</h4>
                            <div class="row">            
                                <div ng-repeat="cl in colors | orderBy : 'name'">
                                    <a class="btn btn-default color-set-button" ng-style="{'border-color':cl.code}" ng-click="setfiltercolorprod(cl.id_color)">{{cl.name}}</a>
                                </div>
                            </div>    
                        </div>                        
                    </div>
                    
                </div>
                <div class="col-md-9 col-sm-9 productslist">
                    <div ng-repeat="p in products">
                        <div class="col-md-3 col-sm-4 col-xs-6 singleproduct">
                            <div class="product-miniature">                            
                                <img src="/img/thumbnail/{{p.file_name}}" class="img-responsive">                            
                            </div>                        
                                <a class="btn btn-info btn-xs product-view" href="/site/productpage?id_product={{p.id_product}}">Смотреть</a>                        
                        </div>
                    </div>                                           
                </div>
            </div>
        </div>
    </div>
</div>    