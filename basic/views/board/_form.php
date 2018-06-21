<!-- 작성필드
    title       글 '제목' 작성
    description 글 '내용' 작성
    date        hidden 적용 (미출력)
    author      글 작성시 '로그인 ID정보' 입력 (수정불가)

    btn - Save      글 작성 '확정':  DB 저장, board index view 전환
    btn - Calcle    글 작성 '취소':  DB 미저장 , board index view 전환
 -->

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
date_default_timezone_set('Asia/Tokyo');

/* @var $this yii\web\View */
/* @var $model app\models\Board */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="board-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textinput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'date')->hiddeninput(['value'=>date('Y-m-d H:i:s')])->label(false); ?>

    <?= $form->field($model, 'author')->textinput(['readOnly'=>true,'value'=> Yii::$app->user->identity->username]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Cancle', ['index', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>
