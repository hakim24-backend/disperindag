<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use backend\components\MainModel;

/**
 * This is the model class for table "pelayanan_instansi".
 *
 * @property integer $id
 * @property string $slug
 * @property string $nama
 * @property string $diskripsi
 * @property integer $created_at
 * @property integer $updated_at
 */
class PelayananInstansi extends MainModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pelayanan_instansi';
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
            ['nama','required'],
            ['nama','unique'],
            [['diskripsi'], 'string'],
            [['nama'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slug' => 'Slug',
            'nama' => 'Nama',
            'diskripsi' => 'Diskripsi',
            'created_at' => 'Dibuat pada',
            'updated_at' => 'Informasi terakhir di update pada',
        ];
    }

    public function simpan()
    {
        if($this->validate())
        {
            $this->slug = $this->makeSlug($this->nama);
            $this->save();
            return true;
        }
        return false;
    }

    public function getJumlahPelayanan()
    {
        $hasil = PelayananInstansiLayanan::find()
                    ->where(['id_pelayanan_instansi'=>$this->id])
                    ->count();
        return $hasil;
    }
}
