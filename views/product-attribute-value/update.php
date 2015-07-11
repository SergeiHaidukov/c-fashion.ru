<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProductAttributeValue */

$this->title = 'Update Product Attribute Value: ' . ' ' . $model->id_pav;
$this->params['breadcrumbs'][] = ['label' => 'Product Attribute Values', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_pav, 'url' => ['view', 'id' => $model->id_pav]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-attribute-value-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
