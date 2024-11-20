<?php
namespace app\models;

use yii\web\UploadedFile;
use yii\helpers\FileHelper;

class Services extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public static function tableName()
    {
        return 'services';
    }

    public function rules()
    {
        return [
            [['description', 'header_image'], 'string'],
            [['name','slogan'], 'string', 'max' => 100],
            [['phone', 'email', 'facebook', 'address'], 'string', 'max' => 250],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'slogan' => 'Slogan',
            'description' => 'Description',
            'phone' => 'Phone',
            'email' => 'Email',
            'facebook' => 'Facebook',
            'address' => 'Address',
            'header_image' => 'Header Image',
            'imageFile' => 'Header Image File',
        ];
    }

    public function upload()
    {
        if ($this->imageFile) {
            // Read the file and convert to base64
            $imageData = file_get_contents($this->imageFile->tempName);
            $this->header_image = base64_encode($imageData);
            return true;
        }
    }

    public function getGalleryImages()
    {
        return $this->hasMany(Image::class, ['id_services' => 'id'])->where(['type' => 'gallery']);
    }
}