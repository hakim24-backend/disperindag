<?php

namespace app\modules\v1\models;

use yii\behaviors\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "komentar".
 *
 * @property integer $id_komentar
 * @property integer $id_berita
 * @property string $id_member_mobile
 * @property string $isi_komentar
 * @property string $tanggal
 * @property string $jam
 * @property string $aktif
 */
class Komentar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'komentar_mobile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_berita', 'id_member_mobile', 'isi_komentar'], 'required'],
            [['id_berita'], 'integer'],
            [['isi_komentar', 'aktif'], 'string'],
            [['tanggal', 'jam'], 'safe'],
        ];
    }
    
    public function behaviors() {
        return [TimestampBehavior::className()];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_komentar' => 'ID Komentar',
            'id_berita' => 'ID Berita',
            'id_member_mobile' => 'Member',
            'isi_komentar' => 'Isi Komentar',
            'tanggal' => 'Tanggal',
            'jam' => 'Jam Komentar',
            'aktif' => 'Aktif',
        ];
    }
    
    public function getBerita() {
        return $this->hasOne(Berita::className(), ['id_berita' => 'id_berita']);
    }
    
    public function getUser() {
        return $this->hasOne(MemberMobile::className(), ['id' => 'id_member_mobile']);
    }
     
    public function fields() {
        return [
            'komentar_id'           => 'id_komentar',
            'komentar_user'         => 'user',
            'komentar_tanggal'      => 'tanggal',
            'komentar_jam'          => 'jam',
            'komentar_isi'          => 'isi_komentar',
            'komentar_status'       => 'aktif',
            'updated_at'            => 'updated_at',
            'created_at'            => 'created_at',                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
        ];
    }
}
