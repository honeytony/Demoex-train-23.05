<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Requests */

$this->title = $model->id;

\yii\web\YiiAsset::register($this);
?>
<div class="requests-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить заявку?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
             'label' => 'Тип транспорта',
             'value' => $model->ship->name
            ],
            'startdate',
            [
                'label' => 'Тип оплаты',
                'value' => $model->payment->name
            ],
            [
                'label' => 'Клиент',
                'value' => $model->user->fullname
            ],
            [
                'label' => 'Статус',
                'value' => $model->status->name
            ],
        ],
    ]) ?>

</div>
