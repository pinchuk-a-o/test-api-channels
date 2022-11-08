<?php

use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ars\Channel */
/* @var $model backend\models\ars\Channel */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Телеканалы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="channel-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Удалить канал?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'created_at',
            'updated_at',
            'title',
            'url',
            [
                'attribute' => 'logo',
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->logo ? Html::img($data->logo) : null;
                }
            ],
            'description:ntext',
        ],
    ]) ?>

</div>
