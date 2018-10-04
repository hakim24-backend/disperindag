<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "blok_ip".
 *
 * @property int $id_blok
 * @property string $ip_address
 * @property string $sampai
 * @property int $status
 */
class BlokIp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blok_ip';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ip_address', 'sampai', 'status'], 'required'],
            [['sampai'], 'safe'],
            [['status'], 'integer'],
            [['ip_address'], 'string', 'max' => 15],
            [['ket'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_blok' => 'Id Blok',
            'ip_address' => 'Ip Address',
            'sampai' => 'Sampai',
            'status' => 'Status',
            'ket' => 'Keterangan',
        ];
    }
}
