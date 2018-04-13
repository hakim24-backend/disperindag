<?php

namespace common\models;

use Yii;
use backend\components\MainModel;

/**
 * This is the model class for table "halamanstatis".
 *
 * @property integer $id_halaman
 * @property string $judul
 * @property string $isi_halaman
 * @property string $tgl_posting
 * @property string $gambar
 */
class HalamanProfil extends MainModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'halamanstatis';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['judul'], 'required'],
            ['judul','unique','message'=>'Judul sudah ada'],
            ['isi_halaman', 'requiredTextarea'],
            [['tgl_posting'], 'safe'],
            [['judul'], 'string', 'max' => 100],
        ];
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
            'gambar' => 'Gambar Thumbnail',
        ];
    }

    public function simpan()
    {
        if($this->isi_halaman == '')
            $this->isi_halaman = false;
        
        if ($this->validate()) {
            if($this->isNewRecord)
                $this->tgl_posting = date("Y-m-d");
            $this->slug = $this->makeSlug($this->judul);
            $this->save();
            return true;
        }else{
            return false;
        }
    }
}
