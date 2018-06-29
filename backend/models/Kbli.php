<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "kbli".
 *
 * @property int $id
 * @property string $kode
 * @property string $nama
 *
 * @property Industri[] $industris
 */
class Kbli extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kbli';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode'], 'string', 'max' => 50],
            [['nama'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode' => 'Kode',
            'nama' => 'Nama',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIndustris()
    {
        return $this->hasMany(Industri::className(), ['kbli' => 'id']);
    }
}
