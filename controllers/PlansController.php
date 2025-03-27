<?php

namespace app\controllers;

use app\models\Plans;
use app\models\PlansSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use Yii;
use app\models\Image;
/**
 * PlansController implements the CRUD actions for Plans model.
 */
class PlansController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Plans models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PlansSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Plans model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Plans model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($id)
    {
        $model = new Plans();
        $model->id_service = $id; 
    
        if ($this->request->isPost) {
            $model->load($this->request->post());
            if ($model->save()) {
                $this->saveGalleryImages($model);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } 
    
        return $this->render('create', [
            'model' => $model,
            'planId' => $id,
        ]);
    }
    
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
    
        if ($this->request->isPost) {
            $model->load($this->request->post());
            if ( $model->save()) {
                $this->saveGalleryImages($model);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
    
        return $this->render('update', [
            'model' => $model,
        ]);
    }
    /**
     * Deletes an existing Plans model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
    
        // Eliminar las imágenes relacionadas
        Image::deleteAll(['id_plan' => $id]);
    
        // Eliminar el plan
        $model->delete();
    
        // Enviar respuesta JSON indicando éxito
        return $this->refresh();
    }
    /**
     * Finds the Plans model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Plans the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Plans::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function saveGalleryImages($model)
    {
        $existingImageIds = Yii::$app->request->post('ExistingImages', []);
        $existingIds = !empty($existingImageIds) ? array_column($existingImageIds, 'id') : [];
        
        $deleteResult = Image::deleteAll([
            'AND', 
            ['id_plan' => $model->id],
            ['type' => 'gallery'],
            ['NOT IN', 'id', $existingIds]
        ]);
    
        // Add new images
        $newImages = Yii::$app->request->post('NewImages', []);
        foreach ($newImages as $imageData) {
            $image = new Image();
            $image->id_plan = $model->id;
            $image->base64_image = $imageData['base64_image'];
            $image->type = 'gallery';
            $image->created_at = date('Y-m-d H:i:s');
            
            if (!$image->save()) {
                // Log save errors
                Yii::error('Failed to save gallery image: ' . print_r($image->errors, true));
            }
        }
    }
}
