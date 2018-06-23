<?php

/* @var $this yii\web\View */

$this->title = 'HOME';
?>
<div class="site-index">

    <!-- <div class="jumbotron"> -->
    <hr style="border: solid 2px">    <h1 style="text-align:center">GridView 게시판 구축</h1>
    <hr style="border: solid 2px">
        
    <!-- </div> -->

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Version</h2>

<pre>
Tool - VSCode: 1.24.1(x64)
PHP : 7.2.6 (x64)
Framework - Yii2 (x64)
DB - SQLite : 3.10.1 (x64)
localhost : Apache Web Server
</pre>
<br>
<pre>yii-basic-app-2.0.15 기본 템플릿 이용
                     (공식홈페이지 다운로드)</pre>

             
            </div>
            <div class="col-lg-4">
                <h2>추가사항</h2>

<pre>
basic/
    controllers/ 
        BoardController.php
    dbData/
        TEST.db
    models/
        Board.php
        BoardSearch.php
    views/
        _form.php
        _search.php
        create.php
        index.php
        update.php
        view.php
----------------------------------------
kartik-v/yii2-grid "@dev" 모듈 적용
</pre>

                
            </div>
            <div class="col-lg-4">
                <h2>기능</h2>

<pre>
GridView 활용, 게시판 구현 
                     Gii활용 Model,CRUD 생성
                     SQLite 연동
--------------------------------------------
kartik GridView로 변경
</pre>
<pre>
게시글 작성 및 열림시 
        complete 기능 추가 (Board 페이지 전환)
        Cancle 기능 추가 
        Update(수정)기능 추가
        글 작성 일시 및 작성자(로그인) 자동 등록
</pre>
<pre>
로그인 // 템플릿 내장 기능 이용 (DB 미사용)
    basic/models/User.php   유저데이터 위치
    
    ID      PASSWORD
    admin   admin
    demo    demo

* 비로그인시 게시판 이용불가, 로그인화면 전환
</pre>

                
            </div>
        </div>

    </div>
</div>
