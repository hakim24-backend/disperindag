<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "hubungi_balas".
 *
 * @property integer $id
 * @property integer $id_hubungi
 * @property string $email
 * @property string $subjek
 * @property string $pesan
 * @property integer $created_at
 */
class ContactBalas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hubungi_balas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'subjek'], 'required'],
            ['pesan', 'requiredTextarea'],
            [['pesan'], 'string'],
            [['email', 'subjek'], 'string', 'max' => 255]
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
            if (!$this->pesan) {
                $this->addError($attribute, 'Pesan harus di isi');
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
            'id_hubungi' => 'Id Hubungi',
            'email' => 'Email',
            'subjek' => 'Subjek',
            'pesan' => 'Pesan',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Relasi Many-to-One dengan model Contact
     * Mengambil kategori post yang berkaitan dengan current post
     */
    public function getBukuTamu()
    {
        return $this->hasOne(Contact::className(), ['id_hubungi' => 'id_hubungi']);
    }

    public function compose()
    {
        if($this->pesan == '')
            $this->pesan = false;

        if($this->validate()){
            if($this->isNewRecord)
                $this->created_at = time();
            $this->email = $this->bukuTamu->email;

            if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') 
                $http = 'https://';
            else 
                $http = 'http://';

            $baseUrl = $http.$_SERVER['SERVER_NAME'];

            $this->pesan = str_replace('<img src="../../common', '<img src="'.$baseUrl.'/common', $this->pesan);
            $this->save();

            Yii::$app->mailer->compose()
                ->setFrom('ppid.disperindagjatim@gmail.com')
                ->setTo($this->email)
                ->setSubject($this->subjek)
                ->setHtmlBody($this->pesan)
                ->send();

            return true;
        }
        return false;
    }
}
