<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kategori".
 *
 * @property integer $id_kategori
 * @property string $nama_kategori
 * @property string $kategori_seo
 * @property string $aktif
 */
class KategoriPost extends \yii\db\ActiveRecord
{
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
            [['nama_kategori'], 'required'],
            //[['aktif'], 'string'],
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
    * Relasi dengan posting
    */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['id_kategori' => 'id_kategori']);
    }
}
