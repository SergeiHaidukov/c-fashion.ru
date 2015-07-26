<?php

use yii\helpers\Html;
use dosamigos\fileupload\FileUploadUI;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Products */

$this->title = 'Update Products: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id_product]];
$this->params['breadcrumbs'][] = 'Update';
?>
<script type="text/javascript" src="/js/angular.min.js"></script>
<script type="text/javascript" src="/js/ui-bootstrap-tpls-0.12.0.min.js"></script>
<script type="text/javascript" src="/js/app.js"></script>
<script type="text/javascript" src="/js/controllers/ProductsController.js"></script>
<script type="text/javascript" src="/js/services/PoductsService.js"></script>
<script type="text/javascript" src="/js/controllers/CategoriesController.js"></script>
<script type="text/javascript" src="/js/services/CategoriesService.js"></script>
<script type="text/javascript" src="/js/angular-cookies.min.js"></script>
<script type="text/javascript" src="/js/angular-route.min.js"></script>
<script type="text/javascript" src="/js/angular-material.min.js"></script>
<script src="//cdn.jsdelivr.net/hammerjs/2.0.4/hammer.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.6/angular-animate.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.6/angular-aria.min.js"></script>
<div class="products-update" ng-app="cfashion">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    <h3>Изображение товара</h3>
    
    <div class="row">        
    <?php    
    //var_dump($files);
    
    $count_miniatures = 0;
    foreach ($files as $filename)
    {
        $count_miniatures++;
    }
    
     foreach ($files as $filename)         
     {?>
        
      <div class="col-md-2">
        <div class="thumbnail">
          <img src= <?php echo (yii\helpers\Url::to('@web/img/thumbnail/'.$filename['file_name'], true)); ?>>
          <div class="caption">            
            <div class="btn-toolbar" role="toolbar">
                <div class="btn-group">
                <?php for($i = 1; $i<=$count_miniatures; $i++){?>
                    <a href="<?php echo (yii\helpers\Url::toRoute(['products/setproductminiature','id_product'=>$model->id_product, 'id_picture_product'=>$filename['id_picture_product'], 'is_miniature'=>$i])); ?>" 
                       class="btn 
                       <?php if ($filename['is_miniature'] == $i)
                            {
                                echo ('btn-warning'); ?>
                      <?php }
                            else 
                            {
                                echo ('btn-default');
                            }
                      ?>                                              
                       btn-xs"><?php echo $i ?></a>
                <?php } ?>
                    <a href="<?php echo (yii\helpers\Url::toRoute(['products/setproductminiature','id_product'=>$model->id_product, 'id_picture_product'=>$filename['id_picture_product'], 'is_miniature'=>-1])); ?>" class="btn btn-default btn-xs" role="button"><i class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <p><a href="<?php echo (yii\helpers\Url::toRoute(['products/delpicprod', 'id_product'=>$model->id_product, 'id_picture'=> $filename['id_picture']])); ?>" class="btn btn-danger btn-xs" role="button">Удалить</a></p>
          </div>
        </div>
      </div>           
    <?php 
     }
    ?>              
    </div>
    <div class="row">
        <?php   
            $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
        ?>

        <?= $form->field($model, 'file[]')->fileInput(['multiple' => true]) ?>

            <button>Submit</button>

        <?php ActiveForm::end(); ?>    
    </div>
    
    
    <div ng-controller="CategoriesController">        
        <h3>Категории</h3> 
        <br/>        
        <div class="row">
            <div ng-repeat="cfp in catprod">  
                <a class="btn btn-default cat-set-button" ng-click="delcatprod(cfp.id)" >{{cfp.name}} <i class="glyphicon glyphicon-remove"></i></a>
            </div>
        </div>    
        <hr/> 
        <div class="row">            
            <div ng-repeat="c in categories">
                <a class="btn btn-default cat-set-button" ng-click="setcatprod(c.id_category)">{{c.name}}</a>
            </div>
        </div>
        
        <div class="row">
            <h3>Цвета и размеры</h3>
            <div class="col-xs-12">
                <div ng-repeat="pt in prodtempprod | orderBy: 'id_color'">
                    <a class="btn btn-default color-set-button btn-sm" ng-style="{'border-color':pt.color_code}" ng-click="delcprodtemp(pt.id_prod_temp)">{{pt.color_name}} {{pt.size_name}}  <i class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>                
        </div>        
        <div class="row">
            <div class="col-xs-4">                
                <table class="table">
                    <tr>
                        <th>
                            Цвет
                        </th>
                        <th>
                            Размер
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <select class="col-xs-12" ng-model="selectedcolor" ng-style="{'border-color':selectedcolor.color_code}" ng-options="cl.color_name for cl in colors"></select>                
                        </td>
                        <td>
                            <select class="col-xs-12" ng-model="selectedsize"  ng-options="sz.size_name for sz in sizes"></select>                
                        </td>
                        <td>
                            <a class="btn btn-default color-set-button col-xs-12 btn-sm" ng-click="setprodtemp(selectedcolor.id_color, selectedsize.id_size)"><i class="glyphicon glyphicon-ok"></i></a>
                        </td>
                    </tr>
                </table>                                             
            </div>
        </div>
        <hr/>
<!--        <div class="row">            
            <div class="col-xs-4">
                <h3>Цвета</h3>
                <div class="col-xs-12">            
                    <div ng-repeat="cp in colprod">
                        <a class="btn btn-default color-set-button btn-sm" ng-style="{'border-color':cp.color_code}" ng-click="delcolprod(cp.ID)">{{cp.color_name}} <i class="glyphicon glyphicon-remove"></i></a>
                    </div>
                </div>    
                <hr/> 
                <div class="col-xs-12">            
                    <div ng-repeat="cl in colors">
                        <a class="btn btn-default color-set-button btn-sm" ng-style="{'border-color':cl.color_code}" ng-click="setcolprod(cl.id_color)">{{cl.color_name}}</a>
                    </div>
                </div>    

                <h3>Размеры</h3>
                <div class="col-xs-12">            
                    <div ng-repeat="s in sizeprod">
                        <a class="btn btn-default sizes-set-button btn-sm" ng-click="delsizeprod(s.ID)">{{s.size_name}} <i class="glyphicon glyphicon-remove"></i></a>
                    </div>
                </div>
                <hr/>
                <div class="col-xs-12">            
                    <div ng-repeat="sz in sizes">
                        <a class="btn btn-default sizes-set-button btn-sm" ng-click="setsizeprod(sz.id_size)">{{sz.size_name}}</a>
                    </div>
                </div>
            </div>
        </div>-->
    </div>    
</div>
