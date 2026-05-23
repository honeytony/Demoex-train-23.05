<?php

use app\models\Payments;
use app\models\Ships;
use app\models\Statuses;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Requests */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="requests-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ship_id')->dropDownList(ArrayHelper::map(Ships::find()->all(), 'id', 'name'), 
    ['prompt' => 'Тип транспорта']) ?>

    <?= $form->field($model, 'startdate')->input('datetime-local') ?>

    <?= $form->field($model, 'payment_id')->dropDownList( ArrayHelper::map(Payments::find()->all(), 'id', 'name'),
    ['prompt' => 'Тип оплаты']
    ) ?>

    <? 

    if(Yii::$app->user->identity->isadmin === 1) {
        echo $form->field($model, 'status_id')->dropDownList( ArrayHelper::map(Statuses::find()->all(), 'id', 'name'));
    }
    
    ?>



    <div class="form-group">
        <?= Html::submitButton('Отправить заявку', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
