<?php

namespace common\models;

use Yii;
use backend\components\MainModel;

/**
 * This is the model class for table "kategori_download".
 *
 * @property integer $id_kategori
 * @property string $nama_kategori
 * @property string $kategori_seo
 * @property string $aktif
 */
class KategoriDownload extends MainModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kategori_download';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_kategori','aktif'], 'required'],
            [['aktif'], 'string'],
            [['nama_kategori'], 'string', 'max' => 50],
            ['nama_kategori', 'unique', 'message' => 'Nama kategori sudah ada.'],
            [['kategori_seo'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_kategori' => 'Id Kategori',
            'nama_kategori' => 'Nama Kategori',
            'kategori_seo' => 'Kategori Seo',
            'aktif' => 'Aktif',
        ];
    }

    /**
     * Mendapatkan julah file download di setiap kategori download
     */ 
    public function getJumlahFile()
    {
        $list_download = Download::find()
                            ->where(['id_kategori'=>$this->id_kategori])
                            ->count();
        return $list_download;
    }

    public function simpan()
    {
        $barukah = 0;
        if($this->isNewRecord)
            $barukah = 1;

        if($this->validate()){
            $this->kategori_seo = $this->makeSlug($this->nama_kategori);
            $this->save();

            if($barukah==1){
                $path = '../'.Yii::$app->params['uploadUrlFile'].$this->kategori_seo."-".md5($this->id_kategori.Yii::$app->params['specialChar1']);
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
            }

            return true;
        }
        return false;
    }
}
