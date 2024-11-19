<?php
namespace app\models;

use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class Image extends ActiveRecord
{
    public $imageFile;

    public static function tableName()
    {
        return 'images';
    }

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'extensions' => 'png, jpg, jpeg'],
            [['base64_image'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nombre',
            'base64_image' => 'Imagen',
            'created_at' => 'Fecha de creación'
        ];
    }
}