<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "industri".
 *
 * @property int $id
 * @property int $badan_usaha
 * @property string $nama_perusahaan
 * @property string $nama_pemilik
 * @property string $jalan
 * @property string $kelurahan
 * @property string $kecamatan
 * @property string $telepon
 * @property string $fax
 * @property string $email
 * @property string $web
 * @property string $izin_usaha_industri
 * @property string $tahun_izin
 * @property int $kbli
 * @property string $komoditi
 * @property string $jenis_produk
 * @property string $cabang_industri
 * @property string $tahun_data
 * @property string $tk_lk
 * @property string $tk_pr
 * @property string $nilai_investasi
 * @property string $jml_kapasitas_produksi
 * @property string $satuan
 * @property string $nilai_produksi
 * @property string $nilai_bb_bp
 * @property string $orientasi_ekspor
 * @property string $negara_tujuan_ekspor
 * @property string $npwp
 * @property int $status
 *
 * @property Kbli $kbli0
 * @property BadanUsaha $badanUsaha
 */
class Industri extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'industri';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['badan_usaha', 'nama_perusahaan', 'nama_pemilik', 'jalan', 'kelurahan', 'kecamatan', 'izin_usaha_industri', 'tahun_izin', 'komoditi', 'jenis_produk', 'tahun_data', 'tk_lk', 'nilai_investasi', 'jml_kapasitas_produksi', 'satuan', 'nilai_produksi', 'nilai_bb_bp', 'npwp', 'status'], 'required'],
            [['badan_usaha', 'kbli', 'status'], 'integer'],
            [['nama_perusahaan', 'jalan', 'jenis_produk', 'cabang_industri'], 'string', 'max' => 100],
            [['nama_pemilik', 'kelurahan', 'kecamatan', 'web', 'izin_usaha_industri', 'tahun_izin', 'komoditi', 'tahun_data', 'tk_lk', 'tk_pr', 'nilai_investasi', 'jml_kapasitas_produksi', 'satuan', 'nilai_produksi', 'nilai_bb_bp', 'orientasi_ekspor', 'negara_tujuan_ekspor'], 'string', 'max' => 50],
            [['telepon', 'fax'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 150],
            [['npwp'], 'integer', 'integerOnly'=>true],
            [['npwp'], 'unique'],
            [['kbli'], 'exist', 'skipOnError' => true, 'targetClass' => Kbli::className(), 'targetAttribute' => ['kbli' => 'id']],
            [['badan_usaha'], 'exist', 'skipOnError' => true, 'targetClass' => BadanUsaha::className(), 'targetAttribute' => ['badan_usaha' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'badan_usaha' => 'Badan Usaha',
            'nama_perusahaan' => 'Nama Perusahaan',
            'nama_pemilik' => 'Nama Pemilik',
            'jalan' => 'Jalan',
            'kelurahan' => 'Kelurahan',
            'kecamatan' => 'Kecamatan',
            'telepon' => 'Telepon',
            'fax' => 'Fax',
            'email' => 'Email',
            'web' => 'Web',
            'izin_usaha_industri' => 'Izin Usaha Industri',
            'tahun_izin' => 'Tahun Izin',
            'kbli' => 'Kbli',
            'komoditi' => 'Komoditi',
            'jenis_produk' => 'Jenis Produk',
            'cabang_industri' => 'Cabang Industri',
            'tahun_data' => 'Tahun Data',
            'tk_lk' => 'TK LK',
            'tk_pr' => 'TK PR',
            'nilai_investasi' => 'Nilai Investasi',
            'jml_kapasitas_produksi' => 'Jml Kapasitas Produksi',
            'satuan' => 'Satuan',
            'nilai_produksi' => 'Nilai Produksi',
            'nilai_bb_bp' => 'Nilai BB BP',
            'orientasi_ekspor' => 'Orientasi Ekspor',
            'negara_tujuan_ekspor' => 'Negara Tujuan Ekspor',
            'npwp' => 'Npwp',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKbli0()
    {
        return $this->hasOne(Kbli::className(), ['id' => 'kbli']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBadanUsaha()
    {
        return $this->hasOne(BadanUsaha::className(), ['id' => 'badan_usaha']);
    }

    public function selectionPerusahaan(){
        $models = Industri::find()->all();
        $selection = [];
        foreach ($models as $model) {
            $selection[$model->id] = $model->npwp.' - '.$model->nama_perusahaan;
        }
        return $selection;
    }
    public function getStatus()
    {
        switch ($this->status) {
            case '1':
                return "<label class='label label-success'>disetujui</label>";
                break;

            default:
                return "<label class='label label-warning'>belum disetujui</label>";
                break;
        }
    }
}
