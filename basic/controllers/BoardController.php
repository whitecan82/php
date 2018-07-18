<?php

namespace app\controllers;

use Yii;
use app\models\Board;
use app\models\BoardSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

date_default_timezone_set('Asia/Tokyo');


/**
 * BoardController implements the CRUD actions for Board model.
 */
class BoardController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Board models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('flagBoardTrue');
            return $this->redirect(array('/site/login',));
        }
        
        $searchModel = new BoardSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 10;
        $dataProvider->sort = ['defaultOrder' => ['id' => 'DESC']]; 

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Board model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model=$this->findModel($id);
        $check = $model->passwordType;        


        if ($model->load(Yii::$app->request->post())) {
            /**
            * 작성자만 '게시물 수정 패스워드'를 초기화 가능
            * 작성자가 '게시물 수정 패스워드'를 설정했을 경우
            *    다른 유저가 패스워드를 알 경우 게시물 수정 가능
            *    (단, 다른 유저가 '게시물 수정 패스워드'의 갱신 및 초기화는 불가능)
            */
            // 작성자, 수정자의 아이디가 동일한 경우, '게시물 수정 패스워드' NULL초기화 가능
            if($model->passwordSet == false && $model->author == Yii::$app->user->identity->username){
                $model->passwordType = NULL;
                $model->save();
            }
            // '스위치' 활성화 및 '게시물 수정 패스워드'가 입력된 경우, DB갱신
            if($model->passwordSet == True){
                // 작성자가 글을 수정할 경우 password유무 무시
                if($model->author == Yii::$app->user->identity->username){
                    $model->save();
                }
                else if($model->passwordType == NULL && $model->passwordText != NULL){
                    $model->passwordType = $model->passwordText;
                    $model->save();
                }
            }
            // db갱신을 위해 입력한 게시물 수정 패스워드가 일치할 경우, 수행
            if($model->passwordType == $model->passwordText && $model->passwordText != NULL){
                $model->save();
            }
            
            return $this->redirect(['view', 'id'=>$model->id]);
        } else {
            return $this->render('view', ['model'=>$model]);
        }


        // return $this->render('view', [
        //     'model' => $this->findModel($id),
        // ]);
    }

    /**
     * Creates a new Board model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Board();

        if ($model->load(Yii::$app->request->post())){
            $model->passwordType = $model->passwordText;
            $model->date = date('Y-m-d H:i');            
            $model->save();
        
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Board model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Board model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Board model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Board the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Board::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
