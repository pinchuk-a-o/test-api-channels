<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ars\Channel */
/* @var $logoFileForm backend\models\forms\ChannelImgForm */

$this->title = 'Создание канала';
$this->params['breadcrumbs'][] = ['label' => 'Телеканалы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="channel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'logoFileForm' => $logoFileForm,
    ]) ?>

</div>
