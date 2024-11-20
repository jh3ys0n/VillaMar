<?php

namespace app\controllers;

use Yii;
use app\models\Services;
use app\models\ServicesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\controllers\ImageController;
use app\models\Image;
/**
 * ServicesController implements the CRUD actions for Services model.
 */
class ServicesController extends Controller
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
     * Lists all Services models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ServicesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Services model.
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

    public function actionCreate()
    {
        $model = new Services();
    
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                // Handle header image upload
                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                
                if ($model->imageFile) {
                    $model->upload();
                }
                
                if ($model->save()) {
                    // Handle gallery images
                    $this->saveGalleryImages($model);
                    
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }
    
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
    
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                // Handle header image upload
                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                
                if ($model->imageFile) {
                    $model->upload();
                }
                
                if ($model->save()) {
                    // Handle gallery images
                    $this->saveGalleryImages($model);
                    
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }
    
        return $this->render('update', [
            'model' => $model,
        ]);
    }
    
    protected function saveGalleryImages($model)
    {
        // Handle existing images (remove those not in the form)
        $existingImageIds = Yii::$app->request->post('ExistingImages', []);
        $existingIds = array_column($existingImageIds, 'id');
        
        // Remove images not in the existing list
        Image::deleteAll([
            'AND', 
            ['id_services' => $model->id],
            ['type' => 'gallery'],
            ['NOT IN', 'id', $existingIds]
        ]);
    
        // Add new images
        $newImages = Yii::$app->request->post('NewImages', []);
        foreach ($newImages as $imageData) {
            $image = new Image();
            $image->id_services = $model->id;
            $image->base64_image = $imageData['base64_image'];
            $image->type = 'gallery';
            $image->created_at = date('Y-m-d H:i:s');
            $image->save();
        }
    }
    /**
     * Deletes an existing Services model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Services model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Services the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Services::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
