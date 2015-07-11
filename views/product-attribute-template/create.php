<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProductAttributeTemplate */

$this->title = 'Create Product Attribute Template';
$this->params['breadcrumbs'][] = ['label' => 'Product Attribute Templates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-attribute-template-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
