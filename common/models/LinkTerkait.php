<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;
use backend\components\MainModel;

/**
 * This is the model class for table "banner".
 *
 * @property integer $id_banner
 * @property string $judul
 * @property string $url
 * @property string $gambar
 * @property string $tgl_posting
 * @property integer $id_kategori
 * @property string $keterangan
 */
class LinkTerkait extends MainModel
{

    public $imageFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['judul', 'url'], 'required'],
            [['keterangan'], 'string', 'max'=>200],
            [['judul'], 'string', 'max' => 100],
            ['url','url'],
            ['status_menu','number'],
            ['imageFile', 'file', 'extensions'=>'png,jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_banner' => 'Id Banner',
            'judul' => 'Judul',
            'url' => 'Url',
            'gambar' => 'Gambar',
            'tgl_posting' => 'Tgl Posting',
            'status_menu' => 'Status Ditampilkan di Menu',
            'keterangan' => 'Keterangan Singkat',
        ];
    }

    /**
     * Get instance UploadFile of imageFile
     * New random name file
     * Assign new random name to gambar field
     */
    public function getImageUpload()
    {

        $this->imageFile = UploadedFile::getInstance($this, 'imageFile');
        if($this->imageFile)
            $this->gambar = $this->getNewNameFile($this->imageFile);
    }

    /**
     * Upload image
     */
    public function uploadImage()
    {
        $path = '../'.Yii::$app->params['uploadUrlOther'];
        $this->upFile($this->imageFile, $path, $this->gambar);
    }
    
    /**
     * Function for save record
     * Rule business for save record in this model
     * @return boolean
     */
    public function simpan()
    {
        $this->getImageUpload();
        if ($this->validate()) {
            if($this->isNewRecord)
                $this->tgl_posting = date("Y-m-d");
            if($this->save()){
                $this->uploadImage();    
                return true;
            }
        }else{
            return false;
        }
    }
}
