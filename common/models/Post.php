<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use backend\components\MainModel;
use yii\imagine\Image;
use Imagine\Image\Box;

/**
 * This is the model class for table "berita".
 *
 * @property integer $id_berita
 * @property integer $id_kategori
 * @property string $username
 * @property string $judul
 * @property string $judul_seo
 * @property string $headline
 * @property string $isi_berita
 * @property string $hari
 * @property string $tanggal
 * @property string $jam
 * @property string $gambar
 * @property integer $dibaca
 * @property string $tag
 */
class Post extends MainModel
{
    public $imageFile;
    public $tmp_imageUpdate;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'berita';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['judul', 'id_kategori'], 'required'],
            ['judul','unique'],
            [['judul','tag'], 'string'],
            ['isi_berita', 'requiredTextarea'],
            ['imageFile', 'file', 'skipOnEmpty'=>false, 'extensions'=>'jpg,png', 'maxSize'=>512000, 'tooBig' => 'Ukuran maksimal file yang bisa diupload 500KB', 'on'=>'create'],
            ['imageFile', 'file', 'skipOnEmpty'=>true, 'extensions'=>'jpg,png', 'on'=>'update'],
            ['imageFile', 'checkWidth'],
        ];
    }

    public function useless($attribute, $params){}

    /**
     * Validation check width of upload image
     */
    public function checkWidth($attribute, $params)
    {
      if(!$this->hasErrors()){
          $image_info = getimagesize($this->imageFile->tempName);
          $image_width = $image_info[0];
          $image_height = $image_info[1];
          
          if($image_width < 800){
            if(!$this->isNewRecord)
              $this->gambar = $this->tmp_imageUpdate;
            $this->addError($attribute, "Agar tampilan layout berita menjadi bagus, disarankan lebar gambar minimal 800px");
          }
      }
    }

    /**
     * Validates required textarea beacause this textarea is a tinymce.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function requiredTextarea($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if (!$this->isi_berita) {
                $this->addError($attribute, 'Isi berita harus di isi');
            }
        }
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_berita' => 'Id Berita',
            'id_kategori' => 'Kategori Post',
            'username' => 'Username',
            'judul' => 'Judul',
            'judul_seo' => 'Judul Seo',
            'headline' => 'Headline',
            'isi_berita' => 'Isi Berita',
            'hari' => 'Hari',
            'tanggal' => 'Tanggal',
            'jam' => 'Jam',
            'gambar' => 'Gambar',
            'dibaca' => 'Dibaca',
            'tag' => 'Tag',
            'imageFile' => 'Gambar Thumbnail',
        ];
    }

    /**
     * Relasi Many-to-One dengan model KategoriPost
     * Mengambil kategori post yang berkaitan dengan current post
     */
    public function getKategoriPost()
    {
        return $this->hasOne(KategoriPost::className(), ['id_kategori' => 'id_kategori']);
    }

    /**
     * get All data from model KategoriPost
     * @return Array
     */
    public function getAllKetegoriPost()
    {
        return ArrayHelper::map(KategoriPost::find()->all(), 'id_kategori', 'nama_kategori');
    }

    /**
     * get All data from model Tag
     * @return Array
     */
    public function getAllTag()
    {
        return ArrayHelper::map(Tag::find()->all(), 'nama_tag', 'nama_tag');   
    }
    

    /**
     * Membuat kalimat untuk thumbnail berita
     */
    public function getStringThumb($str,$maxlen)
    {
        $str = str_replace('&nbsp;', '', trim(preg_replace('/\s+/', ' ', strip_tags($str))));
        $kalimat = explode(".", $str);
        $newstr = $kalimat[0].". ";
        if (strlen($kalimat[0]) <= $maxlen){
            if (array_key_exists(1, $kalimat)) 
                $newstr .= $kalimat[1].". ";
        }

        if (strlen($newstr) <= $maxlen) return $newstr;
        $newstr = substr($newstr, 0, $maxlen);
        if (substr($newstr,-1,1) != ' ') $newstr = substr($newstr, 0, strrpos($newstr, " "));
        return $newstr."...";
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
          if(!$this->isNewRecord)
            $this->tmp_imageUpdate = $this->gambar;
          $this->gambar = $this->getNewNameFile($this->imageFile);
        }
    }

    /**
     * Upload image
     */
    public function uploadImage()
    {
        $path = '../'.Yii::$app->params['uploadUrlPost'];

        $thumbSpesification = [
                                ['width'=>110, 'height'=>100, 'quality'=>80, 'new_path'=>$path ."thumb_mobile/small_"],
                                ['width'=>390, 'height'=>260, 'quality'=>100, 'new_path'=>$path ."thumb/medium_"],
                                ['width'=>800, 'height'=>0, 'quality'=>100, 'new_path'=>$path ."single/"],
                              ];

        $this->upFile($this->imageFile, $path, $this->gambar, true, $thumbSpesification);
    }

    /**
     * Extract tags from array to string
     */
    public function extractTags()
    {
        if(!empty($this->tag)){
            $this->tag = implode(",", $this->tag);
        }
    } 

    /** 
     * Fungsi simpan record data
     */
    public function simpan()
    {
        if($this->isi_berita == '')
            $this->isi_berita = false;

        $this->getImageUpload();
        $this->extractTags();

        if($this->validate()){
            if($this->isNewRecord){
                $this->tanggal = date("Y-m-d");
                $this->jam = date("H:i:s");
                $this->hari = $this->getHari();
                $this->username = Yii::$app->user->identity->username;
            }
            $this->judul_seo = $this->makeSlug($this->judul);
            $this->save();
            $this->uploadImage();
            return true;
        }else{
            $tag_checked = explode(",", $this->tag);
            $this->tag = $tag_checked;
            return false;
        }
    }

    /**
     * Mendapatkan hari dalam bahasa Indonesia
     * @return string
     */
    public function getHari()
    {
      $time = strtotime($this->tanggal);
      $w = date("w",$time);
      switch ($w) {
        case 0:
          return "Minggu";
          break;
        case 1:
          return "Senin";
          break;
        case 2:
          return "Selasa";
          break;
        case 3:
          return "Rabu";
          break;
        case 4:
          return "Kamis";
          break;
        case 5:
          return "Jumat";
          break;
        case 6:
          return "Sabtu";
          break;
        default:
          return  "undifined";
          break;
      }
    }
}
