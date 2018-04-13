<?php

namespace common\models;

use Yii;
use backend\components\MainModel;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "pelayanan_instansi_layanan".
 *
 * @property integer $id
 * @property integer $id_pelayanan_instansi
 * @property string $slug
 * @property string $nama
 * @property string $diskripsi
 * @property integer $created_at
 * @property integer $updated_at
 */
class PelayananInstansiLayanan extends MainModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pelayanan_instansi_layanan';
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
            [['nama'], 'required'],
            ['nama','uniqueInThisInstansi'],
            ['diskripsi', 'requiredTextarea'],
            [['nama'], 'string', 'max' => 255]
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
            if (!$this->diskripsi) {
                $this->addError($attribute, 'Diskripsi harus di isi');
            }
        }
    }

    /**
     * Validates required textarea beacause this textarea is a tinymce.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function uniqueInThisInstansi($attribute, $params)
    {
        if (!$this->hasErrors()) {
            
            $okPeriksalah = true;

            if( ! $this->isNewRecord){
                $oldName = PelayananInstansiLayanan::find()
                            ->where(['id'=>$this->id])->one()->nama;
                if($oldName == $this->nama)
                    $okPeriksalah = false;
            }

            if($okPeriksalah){
                $countNama = PelayananInstansiLayanan::find()
                                ->where(['id_pelayanan_instansi'=>$this->id_pelayanan_instansi,
                                        'nama'=>$this->nama])
                                ->count();
                if($countNama > 0)
                    $this->addError($attribute, 'Nama jenis pelayanan sudah ada');
            }

        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_pelayanan_instansi' => 'Id Pelayanan Instansi',
            'slug' => 'Slug',
            'nama' => 'Nama',
            'diskripsi' => 'Diskripsi',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getInstansi()
    {
        return $this->hasOne(PelayananInstansi::className(), ['id' => 'id_pelayanan_instansi']);
    }

    public function simpan()
    {
        if($this->diskripsi == '')
            $this->diskripsi = false;

        if($this->validate()){
            $this->slug = $this->makeSlug($this->nama);
            $this->save();
            return true;
        }else{
            return false;
        }
    }
}
    