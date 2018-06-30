<!-- board 'main' index view (기본 출력)
    description attribute   내용이 길 경우, 50단어에서 끊고 '...' 출력

    btn - Write     글 작성 view 전환
-->



<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BoardSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Board';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="board-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <!-- <?php  echo $this->render('_search', ['model' => $searchModel]); ?> -->

<br >
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'bootstrap' => true,
        'bordered' => true,
        'hover' => true,
        'striped'=>false,

        // 'export' => [
        //     'fontAwesome'=>false,
        //     // 'label' => 'Print View',
        //     'target' => GridView::TARGET_SELF,
        //     'showConfirmAlert' => false,
        // ],


        'panel' => [
            'heading'=>'<h3 class="panel-title"></i> Board</h3>',
            'type'=>'primary',
            'before'=>
                    '<div style=float:right>&nbsp </div> ' .
                    Html::a('<div class="glyphicon glyphicon-repeat"></div>', 
                        ['index'], 
                        [
                            'class'=>'btn btn-info',
                            'title'=>'Refresh',
                            'style'=>'float:right',
                        ]). 
                    '<div style=float:right>&nbsp </div> ' .
                    Html::a('<div class="glyphicon glyphicon-plus" ></div>', 
                        ['create'], 
                        [
                            'class'=>'btn btn-success',
                            'title'=>'Write',
                            'style'=>'float:right',
                        ]),
            'showfooter'=>false,


            '{export}',
            '{toggleData}',
        ],
        'toggleDataContainer' => ['class' => 'btn-group','style'=>'float:right'],
        'exportContainer' => ['class' => 'btn-group','style'=>'float:right'],
     
        'columns' => [
            [   //  글 id(시리얼) 정보
                'attribute'=>'id',
                'contentOptions' => ['style' => 'width: 10px','align'=> 'middle'],
            ],
            [   //  글 제목 정보
                'attribute'=>'title',
            ],
            [   //  글 내용 정보
                'attribute'=>'description',
                'value'=> function($data){
                    return strlen($data->description) > 50 ? Html::encode(substr($data->description, 0, 50)) . ". . ." : $data->description;
                },
            ],
            [   //  입력날짜 정보
                'attribute'=>'date',
                'contentOptions' => [  
                    'style' => 'width: 160px',
                ],
            ],
            [   //  작성자 정보
                'attribute'=>'author',
                'contentOptions' => ['style' => 'width: 80px'],
            ],
            [   //  기본 액션    보기,수정,삭제
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{view} &nbsp {delete}',
                'header'=>'',
                'contentOptions' => ['style' => 'width: 80px','align'=> 'middle'],
            ],
        ],
    ]); ?>
</div>
