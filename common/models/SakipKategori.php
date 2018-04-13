<?php

namespace common\models;

use Yii;
use backend\components\MainModel;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "sakip_kategori".
 *
 * @property integer $id
 * @property string $nama
 * @property string $slug
 * @property integer $created_at
 * @property integer $updated_at
 */
class SakipKategori extends MainModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sakip_kategori';
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
            ['nama', 'required'],
            ['nama', 'unique', 'message'=>'Kategori laporan dengan nama ini sudah ada'],
            ['nama', 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'slug' => 'Slug',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function simpan()
    {
        if($this->validate())
        {
            $this->makeSlug($this->nama);
            $this->save();
            return true;
        }
        return false;
    }

    public function getFileSakip()
    {
        return $this->hasMany(SakipKategoriFile::className(), ['id_kategori' => 'id']);
    }
}
