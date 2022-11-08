<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ars\Channel */
/* @var $logoFileForm backend\models\forms\ChannelImgForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="channel-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?php if ($model->logo): ?>
        <?= Html::img($model->logo, ['alt' => 'Текущее изображение']) ?>
        <label>
            <?= $form->field($logoFileForm, 'delete_img')->checkbox() ?>
        </label>
    <?php endif; ?>

    <?= $form->field($logoFileForm, 'logo')->fileInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Назад', Url::toRoute('/channel'), ['class' => 'btn btn-info']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
