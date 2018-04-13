<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;
use backend\components\MainModel;
use yii\imagine\Image;
use Imagine\Image\Box;

/**
 * This is the model class for table "gallery".
 *
 * @property integer $id_gallery
 * @property integer $id_album
 * @property string $jdl_gallery
 * @property string $gallery_seo
 * @property string $keterangan
 * @property string $gbr_gallery
 */
class Photo extends MainModel
{
    public $imageFile;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gallery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['jdl_gallery', 'required'],
            [['jdl_gallery','keterangan'], 'string'],
            ['imageFile', 'file', 'skipOnEmpty'=>false, 'extensions'=>'jpg,png', 'on'=>'create'],
            ['imageFile', 'file', 'skipOnEmpty'=>true, 'extensions'=>'jpg,png', 'on'=>'update'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_gallery' => 'Id Gallery',
            'id_album' => 'Id Album',
            'jdl_gallery' => 'Judul Foto',
            'gallery_seo' => 'Gallery Seo',
            'keterangan' => 'Keterangan',
            'gbr_gallery' => 'Foto',
            'imageFile' => 'Foto',
        ];
    }

    /**
     * Relasi Many-to-One dengan model AlbumPhoto
     * Mengambil kategori post yang berkaitan dengan current post
     */
    public function getAlbum()
    {
        return $this->hasOne(AlbumPhoto::className(), ['id_album' => 'id_album']);
    }

    /**
     * Get instance UploadFile of imageFile
     * New random name file
     * Assign new random name to gambar field
     */
    public function getImageUpload()
    {
        $this->imageFile = UploadedFile::getInstance($this, 'imageFile');
        if($this->imageFile){
          $this->gbr_gallery = $this->getNewNameFile($this->imageFile);
        }
    }

    /**
     * Upload image
     */
    public function uploadImage()
    {
        $path_show = $this->getPath("show");
        $path_thumb = $this->getPath("thumb");

        $thumbSpesification = [
                                ['width'=>390, 'height'=>260, 'quality'=>100, 'new_path'=>$path_thumb],
                              ];

        $this->upFile($this->imageFile, $path_show, $this->gbr_gallery, true, $thumbSpesification);
    }

    public function simpan()
    {
        $this->getImageUpload();
        if($this->validate()){
            $this->gallery_seo = $this->makeSlug($this->jdl_gallery);
            $this->save();
            $this->uploadImage();
            return true;
        }
        return false;
    }

    public function getPath($whichOne)
    {
        $folderName = $this->album->album_seo."-".md5($this->id_album.Yii::$app->params['specialChar1']);
        $path = '../'.Yii::$app->params['uploadUrlGallery'].$folderName;
        return $path."/".$whichOne."/";
    }

    public function deleteFilePhoto($file)
    {
        if(file_exists($file))
            unlink($file);
    }
}
