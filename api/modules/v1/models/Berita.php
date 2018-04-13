<?php

namespace app\modules\v1\models;

/**
 * This is the model class for table "berita".
 *
 * @property integer $id_berita
 * @property integer $id_kategori
 * @property string $username
 * @property string $judul
 * @property string $judul_seo
 * @property string $headline
 * @property string $isi_berita
 * @property string $hari
 * @property string $tanggal
 * @property string $jam
 * @property string $gambar
 * @property integer $dibaca
 * @property string $tag
 */
class Berita extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'berita';
    }

    
    public function fields() {
        return [
            'berita_id' => 'id_berita',
            'berita_judul' => 'judul',
            'berita_author' => 'username',
            'berita_judul_seo' => 'judul_seo',
            'berita_kategori' => 'id_kategori',
            'berita_tanggal' => 'tanggal',
            'berita_jam' => 'jam',
            'berita_hari' => 'hari',
            'berita_tag' => 'tag',
            'berita_detail' => 'isi_berita',
            'berita_headline' => 'headline',
            'berita_gambar_url' => 'gambar',
            'berita_kategori' => 'kategori',
        ];
    }

    public function getKategori() {
        return $this->hasOne(Kategori::className(), ['id_kategori' => 'id_kategori']);
    }
    
    public function getKomentar() {
        return $this->hasMany(Komentar::className(), ['id_berita' => 'id_berita']);
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id_kategori', 'username', 'judul', 'judul_seo', 'isi_berita', 'hari', 'tanggal', 'jam', 'gambar', 'tag'], 'required'],
            [['id_kategori', 'dibaca'], 'integer'],
            [['headline', 'isi_berita'], 'string'],
            [['tanggal', 'jam'], 'safe'],
            [['username'], 'string', 'max' => 30],
            [['judul', 'judul_seo', 'gambar', 'tag'], 'string', 'max' => 100],
            [['hari'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id_berita' => 'Id Berita',
            'id_kategori' => 'Id Kategori',
            'username' => 'Username',
            'judul' => 'Judul',
            'judul_seo' => 'Judul Seo',
            'headline' => 'Headline',
            'isi_berita' => 'Isi Berita',
            'hari' => 'Hari',
            'tanggal' => 'Tanggal',
            'jam' => 'Jam',
            'gambar' => 'Gambar',
            'dibaca' => 'Dibaca',
            'tag' => 'Tag',
        ];
    }
    
}
