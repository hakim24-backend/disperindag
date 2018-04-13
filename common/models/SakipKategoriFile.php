<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use backend\components\MainModel;
use yii\web\UploadedFile;
/**
 * This is the model class for table "sakip_ketagori_file".
 *
 * @property integer $id
 * @property integer $id_kategori
 * @property string $nama
 * @property string $file
 * @property integer $created_at
 * @property integer $updated_at
 */
class SakipKategoriFile extends MainModel
{
    public $file_upload;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sakip_ketagori_file';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['nama', 'required'],
            ['nama', 'string', 'max' => 255],
            ['url', 'checkingFile'],
            ['url', 'url'],
            ['file_upload','file','skipOnEmpty'=>true, 'extensions'=>'pdf', 'maxSize'=>20971520, 'tooBig' => 'Ukuran maksimal file yang bisa diupload 20MB']
        ];
    }

    public function checkingFile($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if(!$this->url && !$this->file){
              
                $this->addError($attribute, 'Jika anda tidak dapat mengupload file laporan disini, berilah url link download yang mengarah ke file laporan tersebut');
            }
        }
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_kategori' => 'Id Kategori',
            'nama' => 'Nama',
            'file' => 'File',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'url' => 'Link url'
        ];
    }

    /**
     * Get relation with SakipKategori
     * @return object $this->kategori
     */
    public function getKategori()
    {
        return $this->hasOne(SakipKategori::className(), ['id'=>'id_kategori']);
    }

    /**
     * Get instance UploadFile of file_upload
     * New random name file
     * Assign new random name to gambar field
     */
    public function getImageUpload()
    {
        if($this->url == "" && $this->file == ""){
            $this->file = false;
            $this->url = false;
        }
        
        $this->file_upload = UploadedFile::getInstance($this, 'file_upload');
        if($this->file_upload){
            $this->file = $this->getNewNameFile($this->file_upload);
            $this->url = NULL;
        }else{
            if($this->url){
                $this->file = "";
            }
        }    
    }

    /**
     * Upload image
     */
    public function uploadImage()
    {
        $path = '../'.Yii::$app->params['uploadUrlFile'].'/sakip/';
        $this->upFile($this->file_upload, $path, $this->file);
    }

    /**
     * Untuk simpan record
     * @return boolean
     */
    public function simpan()
    {
        $this->getImageUpload();
        if($this->validate()){                   
            if($this->save()){
                $this->uploadImage();
                return true;
            }
        }
        return false;
    }
}
