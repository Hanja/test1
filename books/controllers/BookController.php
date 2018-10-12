<?php

namespace app\controllers;

use Yii;
use app\models\Book;
use app\models\BookSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;

/**
 * BookController implements the CRUD actions for Book model.
 */
class BookController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['?'],
                        'actions' => ['index', 'view'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                    ],
                ],
                'denyCallback'  => function ($rule, $action) {
                    Yii::$app->session->setFlash('error', 'Возможно только после авторизации.');
                    Yii::$app->user->loginRequired();
                },
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Book models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BookSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = [
            'pageSize' => 5,
        ];
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Book model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Book model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Book();
        $str = date(H).date(i).date(s);
        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model,'image');
            if ($model->validate()) {
                if ($model->imageFile){
                    $model->imageFile->saveAs('image/' . $str . $model->imageFile->baseName . '.' . $model->imageFile->extension);
                    $model->image = 'image/' . $str. $model->imageFile->baseName . '.' . $model->imageFile->extension;
                }
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->name]);
                }
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Book model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $path = $model->image;
        $str = date(H).date(i).date(s);
        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model,'image');
            if ($model->validate()) {
                if ($model->imageFile){
                    $model->imageFile->saveAs('image/' . $str. $model->imageFile->baseName . '.' . $model->imageFile->extension);
                    $model->image = 'image/' . $str. $model->imageFile->baseName . '.' . $model->imageFile->extension;
                }
                unlink($path);
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->name]);
                }
            }
        }
        return $this->render('update', [
                'model' => $model,
            ]);
    }

    /**
     * Deletes an existing Book model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $path = $this->findModel($id)->image;
        $this->findModel($id)->delete();
        unlink($path);
        return $this->redirect(['index']);
    }

    /**
     * Finds the Book model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Book the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Book::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрошенная страница не найдена.');
    }
}
