<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Colors */

$this->title = 'Update Colors: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Colors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id_color]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="colors-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
