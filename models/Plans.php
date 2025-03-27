<?php
namespace app\models;

use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use Yii;

class Plans extends ActiveRecord 
{
    public $imageFile;

    public static function tableName()
    {
        return 'plans';
    }

    public function rules()
    {
        return [
            [['id_service', 'duration'], 'integer'],
            [['description', 'image', 'status'], 'string'],
            [['price'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
            [['id_service'], 'exist', 'skipOnError' => true, 'targetClass' => Services::class, 'targetAttribute' => ['id_service' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_service' => 'Id Service',
            'name' => 'Name',
            'description' => 'Description',
            'price' => 'Price',
            'duration' => 'Duration',
            'image' => 'Image',
            'imageFile' => 'Plan Image',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getService()
    {
        return $this->hasOne(Services::class, ['id' => 'id_service']);
    }

    public function getGalleryImages()
    {
        return $this->hasMany(Image::class, ['id_plan' => 'id'])->where(['type' => 'gallery']);
    }

    public function upload()
    {
        if ($this->validate(['imageFile'])) {
            if ($this->imageFile) {
                $imageData = file_get_contents($this->imageFile->tempName);
                $this->image = base64_encode($imageData);
                return true;
            }
        }
        return false;
    }

    public function afterValidate()
    {
        parent::afterValidate();
        
        if ($this->hasErrors()) {
            Yii::$app->session->setFlash('error', 'Error al subir la imagen: ' . implode(', ', $this->getFirstErrors()));
        }
    }
}