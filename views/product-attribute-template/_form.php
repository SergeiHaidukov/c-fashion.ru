<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductAttributeTemplate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-attribute-template-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_pat')->textInput(['maxlength' => 50]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
