<?php
namespace app\controllers;

use Yii;
use app\models\Image;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\Response;

class ImageController extends Controller
{
    public function actionCreate()
    {
        $model = new Image();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            
            if ($model->imageFile) {
                // Leer el archivo y convertirlo a base64
                $imageData = file_get_contents($model->imageFile->tempName);
                $base64Image = base64_encode($imageData);
                
                // Guardar en la base de datos
                $model->name = $model->imageFile->baseName;
                $model->base64_image = $base64Image;
                $model->created_at = date('Y-m-d H:i:s');
                
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Imagen subida correctamente.');
                    return $this->redirect(['index']);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionIndex()
    {
        $images = Image::find()->all();
        return $this->render('index', [
            'images' => $images
        ]);
    }
}