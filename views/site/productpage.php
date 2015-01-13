<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
//$this->title = 'Product Page';
//$this->params['breadcrumbs'][] = $this->title;
echo \yii\widgets\Breadcrumbs::widget([    
    'links' => [
        [
            'label' => 'Products List',
            'url' => ['/site/productslist'],            
        ],        
        ['label' => 'Product Page']
    ],
]);
?>
<div class="container">
    <div class="row productpage">
        <div class="col-md-7 productpage-foto">            
                <div class="row product-foto-main">
                    <?php
                    $files = $model->getImage($model->id_product);                    
                    $filename = $files[0];
                    ?>
                    <img src="<?php echo (yii\helpers\Url::to('@web/img/'.$filename['file_name'], true)); ?>" class="img-responsive" >
                </div>
                <div class="row">        
                    <?php                    
                     foreach ($files as $filename)
                     {?>
                      <div class="col-md-3">
                        <div class="thumbnail">
                          <img src= "<?php echo (yii\helpers\Url::to('@web/img/thumbnail/'.$filename['file_name'], true)); ?>" class="img-responsive">
                          <!--<div class="caption">
                            <h6><?php// echo ($filename['file_name']) ?></h6>          
                            <p><a href=<?php// echo (yii\helpers\Url::toRoute(['products/delpicprod', 'id_product'=>$model->id_product, 'id_picture'=> $filename['id_picture']])) ?> class="btn btn-danger btn-xs" role="button">Удалить</a></p>
                          </div>-->
                        </div>
                      </div>
                    <?php 
                     }
                    ?>                              
                </div>
        </div>
        <div class="col-md-5 productpage-text maket">
            
        </div>
    </div>
</div>
