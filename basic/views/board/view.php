<!-- 
    글작성 이후, 확인 View 출력 
    글작성 확정 후, DB[date] = 현재시간 적용
    btn  - Complete   -> 글 작성 확인
    btn  - Update     -> 글 수정 전환
    btn  - Delete     -> 글 삭제 
-->

<?php

use yii\helpers\Html;
use kartik\detail\DetailView;   // use yii\widgets\DetailView;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use app\models\DropList;

date_default_timezone_set('Asia/Tokyo');    // 도쿄기준시간 적용

/* @var $this yii\web\View */
/* @var $model app\models\Board */
$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Board', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="board-view">

    <!-- <h1><?= Html::encode('Title: '.$this->title) ?></h1> -->

    <p>
        <?= Html::a(' List', ['index', 'id' => $model->id], [
        'class' => 'btn btn-primary glyphicon glyphicon-list',
        'style' => 'font-size:15px',
        ]) ?>
        <?= Html::a(' Reset', ['view', 'id' => $model->id], [
        'class' => 'btn btn-info glyphicon glyphicon-repeat',
        'style' => 'font-size:15px',
        ]) ?>
        <!-- <?= Html::a('Update', ['update', 'id' => $model->id], [
            'class' => 'btn btn-warning'
        ]) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?> -->
    </p>
    
    <?= $detailview2 = DetailView::widget([
        'container'=>['id'=>'kv-demo1'],
        'model' => $model,
        'condensed'=>true,
        'hover'=>true,
        'striped'=>false,
        'mode'=>DetailView::MODE_VIEW,
        'options' => [
            'style' => 'font-size:17px;',
        ],

        'panel'=>[
            'heading'=>'PROJECT',
            'type'=>DetailView::TYPE_PRIMARY,
        ],
        'attributes' => [
            [
                'group'=>true,
                'label'=>'&nbsp Board Details',
                'rowOptions'=>['style'=>'background-color:#d1e6fa']
            ],
            [
                'columns' => [
                    [
                        'attribute'=>'id', 
                        'label'=>'Board Number',
                        'valueColOptions'=>['style'=>'width:30%'],
                        'displayOnly'=>true,
                    ],
                    [
                        'attribute'=>'author',
                        'label'=>'Author', 
                        'value'=>$model->author,
                        'valueColOptions'=>['style'=>'width:30%'], 
                        'displayOnly'=>true
                    ],
                ],
            ],
            [
                'columns' => [
                    [
                        'attribute'=>'passwordSet', 
                        'label'=>'Modification',
                        'type'=>DetailView::INPUT_SWITCH,
                        'value'=>$model->passwordSet?'On':'Off',
                        'valueColOptions'=>['style'=>'width:30%'],
                        'displayOnly'=>(Yii::$app->user->identity->username == $model->author)?"":"true",
                        'widgetOptions' => [
                            'pluginEvents' => [
                                'switchChange.bootstrapSwitch'  => 'function(e,state) { 
                                    if(state){
                                        document.getElementById("board-passwordtext").removeAttribute("disabled");
                                        document.getElementById("board-passwordtext").placeholder="input password ...";
                                    }
                                    else{
                                        document.getElementById("board-passwordtext").setAttribute("disabled", "");
                                        document.getElementById("board-passwordtext").placeholder="password will set NULL";
                                        document.getElementById("board-passwordtext").value="";
                                    }
                                 }',
                            ],
                        ],
                    ],
                    [
                        'attribute'=>'passwordText',
                        'label'=>'Modification CODE', 
                        'type'=>DetailView::INPUT_PASSWORD,
                        'value'=>'',
                        'options' => [
                            'placeholder' => $model->passwordSet?'input password ...':'',
                            'disabled'=> $model->passwordSet?false:true,    
                        ],
                        'valueColOptions'=>['style'=>'width:30%'], 
                        
                    ],
                ],
            ],
            [
                'group'=>true,
                'label'=>'&nbsp Project Details',
                'rowOptions'=>['style'=>'background-color:#d1e6fa']
            ],
            [
                'columns' => [
                    [
                        'attribute'=>'title', 
                        'label'=>'Title',
                        'value'=>$model->title,
                        'formOptions'=>[
                            'enableAjaxValidation'=>true,
                        ],
                        'options' => [
                            'placeholder' => 'Project Name ...',
                        ],
                        'inputContainer' => ['class'=>'col-sm-12'],
                        'valueColOptions'=>['style'=>'width:30%']
                    ],
                    [
                        'attribute'=>'startDate', 
                        'label'=>'Start Date',
                        'format'=>'date',
                        'type'=>DetailView::INPUT_DATE,
                        'options' => [
                            'placeholder' => 'Select Start Date ...',
                        ],
                        'widgetOptions' => [
                            'pluginOptions'=>['format'=>'yyyy-mm-dd'],
                            
                        ],
                        'inputContainer' => ['class'=>'col-sm-12'],
                        'valueColOptions'=>['style'=>'width:30%'], 
                    ],
                ],
            ],
            [
                'columns' => [
                    [
                        'attribute'=>'people',
                        'label'=>'Participants',
                        'value'=>$model->people,
                        'formOptions'=>[
                            'enableAjaxValidation'=>true,
                        ],
                        'options' => [
                            'placeholder' => 'Participants Number ...',
                        ],
                        'inputContainer' => ['class'=>'col-sm-12'],
                        'valueColOptions'=>['style'=>'width:30%;'],
                    ],
                    [
                        'attribute'=>'endDate', 
                        'label'=>'End Date',
                        'format'=>'date',
                        'type'=>DetailView::INPUT_DATE,
                        'options' => [
                            'placeholder' => 'Select End Date ...',
                        ],
                        'widgetOptions' => [
                            'pluginOptions'=>['format'=>'yyyy-mm-dd']
                        ],
                        'inputContainer' => ['class'=>'col-sm-12'],
                        'valueColOptions'=>['style'=>'width:30%'], 
                    ],
                    
                ],
            ],
            [
                'columns' => [
                    [
                        'attribute'=>'type_id',
                        'label'=>'Work Type',
                        'type'=>DetailView::INPUT_SELECT2,
                        'value'=>ArrayHelper::map(DropList::find()->all(),'id','typeName')[$model->type_id],
                        'widgetOptions'=>[
                            'data'=> ArrayHelper::map(DropList::find()->all(),'id','typeName'),
                        ],
                        'valueColOptions'=>[
                            'style'=>'width:30%;','vAlign'=> 'top',
                        ],
                        
                    ],
                    [
                        'attribute'=>'endTime',
                        'label'=>'End Time', 
                        'type'=>DetailView::INPUT_TIME,
                        'value'=>$model->endTime,
                        'valueColOptions'=>[
                            'class'=>'edittime',
                            'style'=>'width:30%;','vAlign'=> 'top',
                        ],
                        'inputContainer' => ['class'=>'col-sm-12',],
                    ],
                ],
            ],
            [
                'columns' => [
                    [
                        'attribute'=>'description',
                        'label'=>'Description',
                        'value'=>$model->description,
                        'type'=>DetailView::INPUT_TEXTAREA,
                        'options' => [
                            'rows'=>6,
                            'placeholder' => 'Descript project ...',
                        ],
                        'valueColOptions'=>['style'=>'width:80%'], 
                        'inputContainer' => ['class'=>'col-sm-12'],
                    ],
                    
                ],
                
            ],
        ],  
        'deleteOptions' => [
            'params' => ['custom_param' => true, 'id' => $model->id],
            'url' => ['delete', 'id' => $model->id],
            // 'data' => [
            //     'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
            //     'method' => 'post',
            // ],
        ],
    ])?>
</div>