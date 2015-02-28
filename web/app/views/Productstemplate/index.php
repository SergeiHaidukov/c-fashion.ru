<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductsTemplateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products Templates';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-template-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Products Template', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_prod_temp',
            'id_product',
            'id_color',
            'id_size',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
