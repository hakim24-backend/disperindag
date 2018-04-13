<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "hm_account_profile".
 *
 * @property integer $id
 * @property integer $account_id
 * @property string $auth_key
 * @property string $nip
 * @property string $name
 * @property integer $bidang_id
 * @property integer $subbag_id
 * @property string $email_alternatif
 * @property string $password_reset_token
 * @property string $phone_number
 * @property string $address
 * @property integer $gender
 * @property string $birthday
 * @property string $in_time_agencies
 */
class MailAccountProfile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hm_account_profile';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_mail');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'auth_key', 'nip', 'name', 'bidang_id', 'subbag_id', 'email_alternatif'], 'required'],
            [['account_id', 'bidang_id', 'subbag_id', 'gender','seen'], 'integer'],
            [['address'], 'string'],
            [['birthday', 'in_time_agencies'], 'safe'],
            [['auth_key'], 'string', 'max' => 32],
            [['nip'], 'string', 'max' => 23],
            [['name', 'email_alternatif', 'password_reset_token'], 'string', 'max' => 255],
            [['phone_number'], 'string', 'max' => 15]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'account_id' => 'Account ID',
            'auth_key' => 'Auth Key',
            'nip' => 'Nip',
            'name' => 'Name',
            'bidang_id' => 'Bidang ID',
            'subbag_id' => 'Subbag ID',
            'email_alternatif' => 'Email Alternatif',
            'password_reset_token' => 'Password Reset Token',
            'phone_number' => 'Phone Number',
            'address' => 'Address',
            'gender' => 'Gender',
            'birthday' => 'Birthday',
            'in_time_agencies' => 'In Time Agencies',
        ];
    }

    /**
    * Relasi dengan Mail Account
    */
    public function getAccount()
    {
        return $this->hasOne(MailAccount::className(), ['accountid' => 'account_id']);
    }

    /**
    * Relasi dengan bidang
    */
    public function getBidang()
    {
        return $this->hasOne(AccountBidang::className(), ['id' => 'bidang_id']);
    }

    /**
    * Relasi dengan bidang
    */
    public function getSubbag()
    {
        return $this->hasOne(AccountSubbag::className(), ['id' => 'subbag_id']);
    }

    /**
     * Update seen
     */
    public function seen()
    {
        if($this->seen == 0){
            $this->seen = 1;
            $this->save();
            // var_dump($this->errors);
        }
    }
}
