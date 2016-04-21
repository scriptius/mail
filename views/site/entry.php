<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'roleId')->hiddenInput(['value'=>2])->label('') ?>
<?= $form->field($model, 'status')->hiddenInput(['value'=>true])->label('') ?>
<?= $form->field($model, 'login')->label('Логин') ?>
<?= $form->field($model, 'firstName')->label('Фамилия') ?>
<?= $form->field($model, 'lastName')->label('Имя') ?>
<?= $form->field($model, 'patronymic')->label('Отчество') ?>


<?= $form->field($model, 'email')->label('e-mail') ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>