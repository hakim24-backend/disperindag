<?php

namespace common\models;

use Yii;
use backend\components\MainModel;

/**
 * This is the model class for table "album".
 *
 * @property integer $id_album
 * @property string $jdl_album
 * @property string $album_seo
 * @property string $gbr_album
 * @property string $aktif
 */
class AlbumPhoto extends MainModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'album';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jdl_album','aktif'], 'required'],
            ['jdl_album','unique'],
            ['jdl_album', 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_album' => 'Id Album',
            'jdl_album' => 'Judul Album',
            'album_seo' => 'Album Seo',
            'aktif' => 'Aktif',
            'user_id' => 'Author',
        ];
    }

    /**
     * Relasi one-to-may dengan model Photo
     * Mengambil semua gambar yang berelasi dengan current album
     */
    public function getPhotos()
    {
        return $this->hasMany(Photo::className(), ['id_album' => 'id_album']);
    }

    /**
     * Memodifikasi output dari status
     * @return string
     */
    public function getStatus()
    {
        switch ($this->aktif) {
            case 'Y':
                return "<label class='label label-success'>Aktif</label>";
                break;
            
            default:
                return "<label class='label label-danger'>Tidak Aktif</label>";
                break;
        }
    }

    /**
     * Save record
     */
    public function simpan()
    {
        $barukah = 0;
        if($this->isNewRecord){
            $barukah = 1;
            $this->user_id = Yii::$app->user->identity->username;
        }
        if($this->validate())
        {
            $this->album_seo = $this->makeSlug($this->jdl_album);
            $this->save();
                
            if($barukah==1){
                $path = '..'.Yii::$app->params['uploadUrlGallery'].$this->album_seo."-".md5($this->id_album.Yii::$app->params['specialChar1']);
                if (!file_exists($path)) {
                    mkdir($path."/show", 0777, true);
                    mkdir($path."/thumb", 0777, true);
                }
            }

            return true;
        }
        return false;
    }
}
