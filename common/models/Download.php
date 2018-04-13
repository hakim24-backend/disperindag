<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use backend\components\MainModel;
use yii\web\UploadedFile;

/**
 * This is the model class for table "download".
 *
 * @property integer $id_download
 * @property string $judul
 * @property string $nama_file
 * @property string $tgl_posting
 * @property integer $hits
 * @property integer $id_kategori
 */
class Download extends MainModel
{
    public $file_download;
    public $tmp_name_file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'download';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['judul','id_kategori'], 'required'],
            ['judul', 'string', 'max' => 100],
            ['file_download','file','skipOnEmpty'=>false, 'maxSize'=>20971520, 'tooBig' => 'Ukuran maksimal file yang bisa diupload 20MB', 'on'=>'create'],
            ['file_download','file','skipOnEmpty'=>true, 'maxSize'=>20971520, 'tooBig' => 'Ukuran maksimal file yang bisa diupload 20MB', 'on'=>'update'],
            ['file_download','validateFile'],
        ];
    }

    public function validateFile($attribute, $params)
    {
        if (!$this->hasErrors()) {
            // $user = $this->getUser();
            // if (!$user || !$user->validatePassword(md5($this->password))) {
            //     $this->addError($attribute, 'Username atau kata sandi salah.');
            // }
            $ext = explode(".", $this->nama_file);
            if(isset($ext[1])){
            	if($ext[1] != 'rar' && $ext[1] != 'zip' && $ext[1] != 'pdf'){
            		$this->addError($attribute, 'Only files with these extensions are allowed: pdf, zip, rar.');
            		$this->nama_file = $this->tmp_name_file;
            	}
            }else{
            	$this->addError($attribute, 'Only files with these extensions are allowed: pdf, zip, rar.');
            	$this->nama_file = $this->tmp_name_file;
            }
        }
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_download' => 'Id Download',
            'judul' => 'Judul',
            'nama_file' => 'Nama File',
            'tgl_posting' => 'Tgl Posting',
            'hits' => 'Hits',
            'id_kategori' => 'Kategori Download',
            'file_download' => 'File',
        ];
    }

    /**
     * Relasi Many-to-One dengan model KategoriDownload
     * Mengambil kategori post yang berkaitan dengan current post
     */
    public function getKategori()
    {
        return $this->hasOne(KategoriDownload::className(), ['id_kategori' => 'id_kategori']);
    }

    /**
     * get All data from model KategoriDownload
     * @return Array
     */
    public function getAllKetegori()
    {
        return ArrayHelper::map(KategoriDownload::find()->where(['aktif'=>'Y'])->all(), 'id_kategori', 'nama_kategori');
    }

    /**
     * Get instance UploadFile of imageFile
     * New random name file
     * Assign new random name to gambar field
     */
    public function getFileUpload()
    {
        $this->file_download = UploadedFile::getInstance($this, 'file_download');
        if($this->file_download){
        	$this->tmp_name_file = $this->nama_file;
          	$this->nama_file = $this->getNewNameFile($this->file_download);
        }
    }

    /**
     * Upload image
     */
    public function uploadFileDownload()
    {
        $path = $this->getPath();
        if (!file_exists($path)) 
            mkdir($path, 0777, true);
        
        $this->upFile($this->file_download, $path, $this->nama_file);
    }

    public function simpan()
    {
        $this->getFileUpload();
        if($this->validate()){
            if($this->isNewRecord){
              $this->username = Yii::$app->user->identity->username;
              $this->tgl_posting = date("Y-m-d");
            }
            $this->save();
            $this->uploadFileDownload();
            return true;
        }
        return false;
    }

    public function deleteFile($file)
    {
        if(file_exists($file))
            unlink($file);
    }

    public function getPath()
    {
      return '../'.Yii::$app->params['uploadUrlFile'].$this->kategori->kategori_seo."-".md5($this->id_kategori.Yii::$app->params['specialChar1'])."/";
    }

    public function getPathFrontend()
    {
      return Yii::$app->params['uploadUrlFile'].$this->kategori->kategori_seo."-".md5($this->id_kategori.Yii::$app->params['specialChar1'])."/";
    }
}
