<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "account_bidang".
 *
 * @property integer $id
 * @property string $nama
 */
class Kbli extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kbli';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama','kode'], 'required'],
            [['nama','kode'], 'string', 'max' => 255]
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
            'kode' => 'Kode',
        ];
    }
}
