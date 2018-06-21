<!-- board 'main' index view (기본 출력)
    description attribute   내용이 길 경우, 50단어에서 끊고 '...' 출력

    btn - Write     글 작성 view 전환
-->



<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BoardSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Board';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="board-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Write', ['create'], ['class' => 'btn btn-success','style'=>'float:right']) ?>
    </p>
<br >
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
                'contentOptions' => ['style' => 'width: 160px'],

            ],
            [   //  작성자 정보
                'attribute'=>'author',
                'contentOptions' => ['style' => 'width: 80px'],

            ],
            [   //  기본 액션    보기,수정,삭제
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'width: 80px','align'=> 'middle'],
            ],
        ],
    ]); ?>
</div>
