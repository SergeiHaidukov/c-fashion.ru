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
<div class="products-update" ng-app="cfashion">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    <h3>Изображение товара</h3>
    
    <div class="row">        
    <?php
    $files = $model->getImage($model->id_product);    
    //var_dump($files);
     foreach ($files as $filename)         
     {?>
        
      <div class="col-md-2">
        <div class="thumbnail">
          <img src= <?php echo (yii\helpers\Url::to('@web/img/thumbnail/'.$filename['file_name'], true)); ?>>
          <div class="caption">
            <h6><?php if ($filename['is_miniature']== TRUE)
                    {
                        echo ('миниатюра') ?></h6>
              <?php }?>
            <p><a href=<?php echo (yii\helpers\Url::toRoute(['products/delpicprod', 'id_product'=>$model->id_product, 'id_picture'=> $filename['id_picture']])); ?> class="btn btn-danger btn-xs" role="button">Удалить</a></p>
            <p><a href=<?php echo (yii\helpers\Url::toRoute(['products/setproductminiature','id_product'=>$model->id_product, 'id_picture_product'=>$filename['id_picture_product']])); ?> class="btn btn-info btn-xs" role="button">Миниатюра</a></p>
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
    
        <h3>Цвета</h3>
        <div class="row">            
            <div ng-repeat="cp in colprod">
                <a class="btn btn-default color-set-button" ng-style="{'border-color':cp.code}" ng-click="delcolprod(cp.ID)">{{cp.name}} <i class="glyphicon glyphicon-remove"></i></a>
            </div>
        </div>    
        <hr/> 
        <div class="row">            
            <div ng-repeat="cl in colors">
                <a class="btn btn-default color-set-button" ng-style="{'border-color':cl.code}" ng-click="setcolprod(cl.id_color)">{{cl.name}}</a>
            </div>
        </div>    
        
        <h3>Размеры</h3>
        <div class="row">            
            <div ng-repeat="s in sizeprod">
                <a class="btn btn-default sizes-set-button" ng-click="delsizeprod(s.ID)">{{s.name}} <i class="glyphicon glyphicon-remove"></i></a>
            </div>
        </div>
        <hr/>
        <div class="row">            
            <div ng-repeat="sz in sizes">
                <a class="btn btn-default sizes-set-button" ng-click="setsizeprod(sz.id_size)">{{sz.name}}</a>
            </div>
        </div>
        
    </div>    
</div>
