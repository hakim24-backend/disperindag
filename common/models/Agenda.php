<?php

namespace common\models;

use Yii;
use backend\components\MainModel;

/**
 * This is the model class for table "agenda".
 *
 * @property integer $id_agenda
 * @property string $tema
 * @property string $tema_seo
 * @property string $isi_agenda
 * @property string $tempat
 * @property string $pengirim
 * @property string $tgl_mulai
 * @property string $tgl_selesai
 * @property string $tgl_posting
 * @property string $jam
 * @property string $username
 */
class Agenda extends MainModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'agenda';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tema', 'tempat', 'pengirim', 'tgl_mulai', 'tgl_selesai', 'jam'], 'required'],
            ['tema','unique'],
            ['isi_agenda', 'requiredTextarea'],
            [['tgl_mulai', 'tgl_selesai'], 'safe'],
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
            if (!$this->isi_agenda) {
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
            'id_agenda' => 'Id Agenda',
            'tema' => 'Tema',
            'tema_seo' => 'Tema Seo',
            'isi_agenda' => 'Deskripsi Agenda',
            'tempat' => 'Tempat Dilakukan Acara',
            'pengirim' => 'Pengirim',
            'tgl_mulai' => 'Tanggal Mulai',
            'tgl_selesai' => 'Tanggal Selesai',
            'tgl_posting' => 'Tanggal Posting',
            'jam' => 'Jam Mulai Acara',
            'username' => 'Username',
        ];
    }

    public function formatDate($date)
    {
        return date("d M Y",strtotime($date));
    }

    public function simpan()
    {
        if($this->isi_agenda == '')
            $this->isi_agenda = false;
        if($this->validate()){
            if($this->isNewRecord){
                $this->tgl_posting = date("Y-m-d");
                $this->username = Yii::$app->user->identity->username;
            }
            $this->tema_seo = $this->makeSlug($this->tema);
            if($this->save())
                return true;
        }
        return false;
    }
}
