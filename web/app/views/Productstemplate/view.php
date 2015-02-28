<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ProductsTemplate */

$this->title = $model->id_prod_temp;
$this->params['breadcrumbs'][] = ['label' => 'Products Templates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-template-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_prod_temp], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_prod_temp], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_prod_temp',
            'id_product',
            'id_color',
            'id_size',
        ],
    ]) ?>

</div>
