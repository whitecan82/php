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
            <div class="col-lg-8">
                <h2>추가사항</h2>

<pre style=width:100%;>
< 기능 구현 >
    [ BoardView ]-> 'Modification' SwitchButton,
                    'Modification Code' Password Form 
                 
< 기능 설명 >
    SwitchButton :
        ( 글 작성자 == 로그인 id ) -> 버튼 활성화    // 작성자 이외에 password설정 불가능
        작성자가 버튼을 'Off'로 수정 한 경우         // password는 NULL로 초기화
    PasswordForm : 
        DB와 inputtext 대조                         // 암호를 알 경우,누구나 수정 가능
        button에 따라 passwordForm 활성화           // (disabled,display)속성 변경

< 마무리 >
    작성자 : Modification Code 설정 가능
            글을 수정 할 경우, password 입력하지 않아도 수정 가능          

    작성자 외 : 글을 수정 할 경우, password 필요

    View의 css 간단 수정
</pre>

    </div>
</div>
