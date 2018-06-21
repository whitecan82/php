<!-- 
    글작성 이후, 확인 View 출력 
    글작성 확정 후, DB[date] = 현재시간 적용
    btn  - Complete   -> 글 작성 확인
    btn  - Update     -> 글 수정 전환
    btn  - Delete     -> 글 삭제 
-->

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
date_default_timezone_set('Asia/Tokyo');    // 도쿄기준시간 적용

/* @var $this yii\web\View */
/* @var $model app\models\Board */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Board', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="board-view">

    <h1><?= Html::encode('Title: '.$this->title) ?></h1>

    <p>
        <?= Html::a('Complete', ['index', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php $model->date = date('Y-m-d H:i:s'); ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title:ntext',
            'description:ntext',
            'date:ntext',
            'author:ntext',
        ],
    ]) ?>

</div>
