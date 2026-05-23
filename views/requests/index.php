<?php

use app\models\Payments;
use app\models\Ships;
use app\models\Statuses;
use app\models\User;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RequestsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заявки на обучение';
?>
<div class="requests-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать заявку', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                "attribute" => 'ship_id',
                "value" => 'ship.name',
                "filter" => ArrayHelper::map(Ships::find()->all(), 'id', 'name')
            ],
            'startdate',
            [
                "attribute" => 'payment_id',
                "value" => 'payment.name',
                "filter" => ArrayHelper::map(Payments::find()->all(), 'id', 'name')
            ],
            [
                "attribute" => 'user_id',
                "value" => 'user.fullname',
                "filter" => ArrayHelper::map(User::find()->all(), 'id', 'fullname')
            ],
            //'status_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
