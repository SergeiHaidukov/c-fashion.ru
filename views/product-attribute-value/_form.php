<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\ProductAttributeValue */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-attribute-value-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $dataList=ArrayHelper::map(\app\models\ProductAttributeTemplate::find()->asArray()->all(), 'id_pat', 'name_pat'); ?>
    <?= $form->field($model, 'id_pat')->dropDownList($dataList, ['prompt'=>'-Choose a Template-']); ?>

    <?= $form->field($model, 'value_pav')->textInput(['maxlength' => 255]) ?>
    
    <?= $dataListParent=ArrayHelper::map(\app\models\ProductAttributeValue::find()->asArray()->all(), 'id_pav', 'value_pav'); ?>
    <?= $form->field($model, 'parent')->dropDownList($dataListParent, ['prompt'=>'-Choose a Parent-']); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
