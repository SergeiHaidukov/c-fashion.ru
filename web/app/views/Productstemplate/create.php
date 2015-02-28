<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProductsTemplate */

$this->title = 'Create Products Template';
$this->params['breadcrumbs'][] = ['label' => 'Products Templates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-template-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
