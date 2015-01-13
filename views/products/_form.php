<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'oldprice')->textInput() ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'isview')->checkbox() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>       

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
    <?php yii\imperavi\Widget::widget([
            // You can either use it for model attribute
            'htmlOptions' =>[
                'id' => 'products-description',
            ],
            'options' => [
                'buttons' => ['html', 'formatting', 'bold', 'italic', 'deleted',
                            'unorderedlist', 'orderedlist', 'outdent', 'indent',
                            'image', 'file', 'link', 'alignment', 'horizontalrule'],
                'buttonSource' => 'true',
            ],
        ]);?>

</div>