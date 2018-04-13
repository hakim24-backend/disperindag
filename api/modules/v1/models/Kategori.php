<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "kategori".
 *
 * @property integer $id_kategori
 * @property string $nama_kategori
 * @property string $kategori_seo
 * @property string $aktif
 */
class Kategori extends \yii\db\ActiveRecord
{
    
    const KATEGORI_AKTIF = 'Y';
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kategori';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_kategori', 'kategori_seo'], 'required'],
            [['aktif'], 'string'],
            [['nama_kategori'], 'string', 'max' => 50],
            [['kategori_seo'], 'string', 'max' => 100],
        ];
    }
    
    public function getBerita() {
        return $this->hasMany(Berita::className(), ["id_kategori" => "id_kategori"]);
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
}
