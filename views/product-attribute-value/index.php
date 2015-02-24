<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductAttributeValueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Attribute Values';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-attribute-value-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Product Attribute Value', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_pav',
            'id_pat',
            'value_pav',
            'parent',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
