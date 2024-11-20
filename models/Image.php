<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\UploadedFile;

use Yii;

/**
 * This is the model class for table "images".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $base64_image
 * @property string|null $created_at
 * @property string|null $description
 * @property string|null $type
 * @property int|null $id_services
 *
 * @property Services $services
 */
class Image extends \yii\db\ActiveRecord
{

    public $imageFile;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['imageFile'], 'file', 'extensions' => 'png, jpg, jpeg'],
            [['base64_image', 'description'], 'string'],
            [['created_at'], 'safe'],
            [['id_services'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 50],
            [['id_services'], 'exist', 'skipOnError' => true, 'targetClass' => Services::class, 'targetAttribute' => ['id_services' => 'id']],
        ];
    }

}