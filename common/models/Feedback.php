<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "feedback".
 *
 * @property int $id
 * @property string $tanggal
 * @property string $nama
 * @property string $email
 * @property string $subject
 * @property string $feedback
 */
class Feedback extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feedback';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama', 'email', 'subject', 'feedback'], 'required'],
            [['feedback'], 'string'],
            [['nama'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 100],
            [['subject'], 'string', 'max' => 20],
            // [['seen'], 'ring', 'max' => 20],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tanggal' => 'Tanggal',
            'nama' => 'Nama',
            'email' => 'Email',
            'subject' => 'Subject',
            'feedback' => 'Feedback',
        ];
    }
}
