<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProductsTemplate */

$this->title = 'Update Products Template: ' . ' ' . $model->id_prod_temp;
$this->params['breadcrumbs'][] = ['label' => 'Products Templates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_prod_temp, 'url' => ['view', 'id' => $model->id_prod_temp]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="products-template-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
