<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProductAttributeTemplate */

$this->title = 'Update Product Attribute Template: ' . ' ' . $model->id_pat;
$this->params['breadcrumbs'][] = ['label' => 'Product Attribute Templates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_pat, 'url' => ['view', 'id' => $model->id_pat]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-attribute-template-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
