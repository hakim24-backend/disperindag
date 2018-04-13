<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;
use backend\components\MainModel;
use yii\imagine\Image;
use Imagine\Image\Box;
/**
 * This is the model class for table "upt".
 *
 * @property integer $id_halaman
 * @property string $judul
 * @property string $isi_halaman
 * @property string $tgl_posting
 * @property string $gambar
 */
class UptIndag extends MainModel
{
    public $imageFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'upt';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['judul'], 'required'],
            [['judul'], 'unique', 'message'=>'Judul sudah ada'],
            ['isi_halaman', 'requiredTextarea'],
            [['tgl_posting'], 'safe'],
            [['judul', 'gambar'], 'string'],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'on'=>'create'],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'on'=>'update'],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['judul','isi_halaman','imageFile'];//Scenario Values Only Accepted
        $scenarios['update'] = ['judul','isi_halaman','imageFile'];
        return $scenarios;
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
            if (!$this->isi_halaman) {
                $this->addError($attribute, 'Isi halaman harus di isi');
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_halaman' => 'Id Halaman',
            'judul' => 'Judul',
            'isi_halaman' => 'Isi Halaman',
            'tgl_posting' => 'Tgl Posting',
            'gambar' => 'Gambar',
            'imageFile' => "Gambar Thumbnail",
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
        if($this->imageFile){
            $new_namefile = time() . Yii::$app->security->generateRandomString(5) . '.' . $this->imageFile->extension;
            $this->gambar = $new_namefile;
        }
    }

    /**
     * Upload image
     * Create new image but with resize for image thumbnail
     */
    public function uploadImage()
    {
        $path = '../'.Yii::$app->params['uploadUrlOther'];
        if($this->imageFile){
            $this->imageFile->saveAs($path.$this->gambar);
            Image::thumbnail($path.$this->gambar, 250, 190)
            ->save(Yii::getAlias($path ."thumb/". $this->gambar), ['quality' => 80]);
            //$imagine = Image::getImagine();
            //$photo = $imagine->open($path.$this->gambar);
            //$photo->thumbnail(new Box(220, 220))->save($path ."thumb/". $this->gambar, ['quality' => 90]);
        }
    }
    
    /**
     * Function for save record
     * Rule business for save record in this model
     * @return boolean
     */
    public function simpan()
    {
        if($this->isi_halaman == '')
            $this->isi_halaman = false;

        $this->getImageUpload();
        if ($this->validate()) {
            if($this->isNewRecord)
                $this->tgl_posting = date("Y-m-d");
            $this->slug = $this->makeSlug($this->judul);
            if($this->save()){
                $this->uploadImage();    
                return true;
            }
        }else{
            return false;
        }
    }
}
