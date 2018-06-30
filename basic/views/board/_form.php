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
use kartik\widgets\DatePicker;
use kartik\widgets\TimePicker;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use app\models\DropList;

date_default_timezone_set('Asia/Tokyo');

/* @var $this yii\web\View */
/* @var $model app\models\Board */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="board-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="panel panel-default">
    <div class="panel-heading" style="font-size:25px">Write</div>
        <div class="panel-body">
            <div class="row ">
                <div class="col-sm-6">
                    <?= $form->field($model, 'title')->textinput([
                        'placeholder' => 'Project Name...',
                    ]) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'startDate')->widget(DatePicker::class, [
                        'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                        'options' => [
                            'placeholder' => 'Select start date ...',
                            'autocomplete' => 'off',
                        ],
                        'pluginOptions' => [
                            'autoclose'=>true,
                            'format' => 'yyyy-mm-dd',
                            
                        ]
                    ])?>
                </div>
            </div>
            <div class="row ">
                <div class="col-sm-6">
                    <?= $form->field($model, 'type_id')->widget(Select2::classname(), [
                        'data' =>  ArrayHelper::map(DropList::find()->all(),'id','typeName'),
                        'options' => [
                            'placeholder' => 'Select a worktype ...',
                            'class' => 'form-inline',
                        ],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ]
                    ])?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'endDate')->widget(DatePicker::class, [
                        'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                        'options' => [
                            'placeholder' => 'Select end date ...',
                            'autocomplete' => 'off',
                        ],
                        'pluginOptions' => [
                            'autoclose'=>true,
                            'format' => 'yyyy-mm-dd',
                            
                        ]
                    ])?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'people')->textinput([
                        'placeholder' => 'Participants number ...',
                        'options' => [
                            'autocomplete' => 'off',
                        ],
                    ]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'description')->textarea([
                        'rows' => 6,
                        'placeholder' => 'Descripte project ...',
                    ]) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'endTime')->widget(TImePicker::class, [
                        'options' => [
                            'autocomplete' => 'off',
                        ],
                        'pluginOptions' => [
                            'attribute' => 'created_at',
                        'mode' => 'datetime',
                            'autoclose'=>true,
                            'format'=>'yyyy-mm-dd',
                        ]
                    ])?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <?= $form->field($model, 'author')->textinput(['readOnly'=>true,'value'=> Yii::$app->user->identity->username]) ?>
                </div>
            </div>
        </div>
    </div>
        
        <?= $form->field($model, 'date')->hiddeninput(['value'=>date('Y-m-d H:i')])->label(false); ?>
        
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            <?= Html::a('Cancle', ['index', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
