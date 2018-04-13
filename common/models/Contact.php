<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "hubungi".
 *
 * @property integer $id_hubungi
 * @property string $nama
 * @property string $email
 * @property string $subjek
 * @property string $pesan
 * @property string $tanggal
 * @property string $tampilkan
 */
class Contact extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hubungi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama', 'email', 'subjek', 'pesan'], 'required'],
            [['pesan'], 'string'],
            [['nama'], 'string', 'max' => 50],
            [['email', 'subjek'], 'string', 'max' => 100],
            [['tampilkan'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_hubungi' => 'Id Hubungi',
            'nama' => 'Nama',
            'email' => 'Email',
            'subjek' => 'Subjek',
            'pesan' => 'Pesan',
            'tanggal' => 'Tanggal',
            'tampilkan' => 'Tampilkan',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->nama = htmlspecialchars($this->nama);
            $this->subjek = htmlspecialchars($this->subjek);
            $this->pesan = htmlspecialchars($this->pesan);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Memotong kalimat agar terpotong diakhir kata tidak ditengah-tengah kata
     * Digunakan pada fungsi getStringThumb
     */
    public function truncate_str($str, $maxlen) {
      if (strlen($str) <= $maxlen) return $str;
      $newstr = substr($str, 0, $maxlen);
      if (substr($newstr,-1,1) != ' ') $newstr = substr($newstr, 0, strrpos($newstr, " "));
      return $newstr;
    }

    /**
     * Membuat kalimat untuk thumbnail berita
     */
    public function getStringThumb($str,$maxlen)
    {
        return $this->truncate_str(str_replace('&nbsp;', '', trim(preg_replace('/\s+/', ' ', strip_tags($str)))),$maxlen);
    }

    /**
     * Update seen
     */
    public function seen()
    {
        if($this->seen == 0){
            $this->seen = 1;
            $this->save();
        }
    }

    /**
     * show status tampil
     */
    public function showStatusTampil()
    {
        switch ($this->tampilkan) {
            case 'Y':
                return "<label class='label label-success'>Ditampilkan</label>";
                break;
            
            default:
                return "<label class='label label-danger'>Tidak Ditampilkan</label>";
                break;
        }
    }

    /**
     * Mengembalikan status buku tamu apakah sudah ditanggapi atau belum
     * @return int 0=menunggu tanggapan,1=sudah ditanggapi
     */
    public function getStatus()
    {

        $balasan= ContactBalas::find()
                 ->where(["id_hubungi"=>$this->id_hubungi])
                 ->one();

        if($balasan!=null||$balasan!="")
        {
          return 1;
        }else{
          return 0;
        }

    }

    public function getPesan()
    {
        $pesan = htmlspecialchars($this->pesan);
        return $pesan;
    }
}
