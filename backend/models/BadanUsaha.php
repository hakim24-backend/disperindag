<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "badan_usaha".
 *
 * @property int $id
 * @property string $nama_badan_usaha
 */
class BadanUsaha extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'badan_usaha';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_badan_usaha'], 'required'],
            [['nama_badan_usaha'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_badan_usaha' => 'Nama Badan Usaha',
        ];
    }
}
