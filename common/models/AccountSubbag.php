<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "account_subbag".
 *
 * @property integer $id
 * @property integer $id_bidang
 * @property string $nama
 */
class AccountSubbag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'account_subbag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_bidang', 'nama'], 'required'],
            [['id_bidang'], 'integer'],
            [['nama'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_bidang' => 'Id Bidang',
            'nama' => 'Nama',
        ];
    }

    /**
    * Relasi dengan bidang
    */
    public function getBidang()
    {
        return $this->hasOne(AccountBidang::className(), ['id' => 'id_bidang']);
    }
}
