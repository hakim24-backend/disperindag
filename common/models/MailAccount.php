<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "hm_accounts".
 *
 * @property integer $accountid
 * @property integer $accountdomainid
 * @property integer $accountadminlevel
 * @property string $accountaddress
 * @property string $accountpassword
 * @property integer $accountactive
 * @property integer $accountisad
 * @property string $accountaddomain
 * @property string $accountadusername
 * @property integer $accountmaxsize
 * @property integer $accountvacationmessageon
 * @property string $accountvacationmessage
 * @property string $accountvacationsubject
 * @property integer $accountpwencryption
 * @property integer $accountforwardenabled
 * @property string $accountforwardaddress
 * @property integer $accountforwardkeeporiginal
 * @property integer $accountenablesignature
 * @property string $accountsignatureplaintext
 * @property string $accountsignaturehtml
 * @property string $accountlastlogontime
 * @property integer $accountvacationexpires
 * @property string $accountvacationexpiredate
 * @property string $accountpersonfirstname
 * @property string $accountpersonlastname
 */
class MailAccount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hm_accounts';
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
            [['accountaddress', 'accountpassword'], 'required'],
            [['accountdomainid', 'accountadminlevel', 'accountactive', 'accountisad', 'accountmaxsize', 'accountvacationmessageon', 'accountpwencryption', 'accountforwardenabled', 'accountforwardkeeporiginal', 'accountenablesignature', 'accountvacationexpires'], 'integer'],
            [['accountvacationmessage', 'accountsignatureplaintext', 'accountsignaturehtml'], 'string'],
            [['accountlastlogontime', 'accountvacationexpiredate'], 'safe'],
            [['accountaddress', 'accountpassword', 'accountaddomain', 'accountadusername', 'accountforwardaddress'], 'string', 'max' => 255],
            [['accountvacationsubject'], 'string', 'max' => 200],
            [['accountpersonfirstname', 'accountpersonlastname'], 'string', 'max' => 60],
            [['accountaddress'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'accountid' => 'Accountid',
            'accountdomainid' => 'Accountdomainid',
            'accountadminlevel' => 'Accountadminlevel',
            'accountaddress' => 'Alamat Email',
            'accountpassword' => 'Accountpassword',
            'accountactive' => 'Status Aktif',
            'accountisad' => 'Accountisad',
            'accountaddomain' => 'Accountaddomain',
            'accountadusername' => 'Accountadusername',
            'accountmaxsize' => 'Accountmaxsize',
            'accountvacationmessageon' => 'Accountvacationmessageon',
            'accountvacationmessage' => 'Accountvacationmessage',
            'accountvacationsubject' => 'Accountvacationsubject',
            'accountpwencryption' => 'Accountpwencryption',
            'accountforwardenabled' => 'Accountforwardenabled',
            'accountforwardaddress' => 'Accountforwardaddress',
            'accountforwardkeeporiginal' => 'Accountforwardkeeporiginal',
            'accountenablesignature' => 'Accountenablesignature',
            'accountsignatureplaintext' => 'Accountsignatureplaintext',
            'accountsignaturehtml' => 'Accountsignaturehtml',
            'accountlastlogontime' => 'Terakhir login',
            'accountvacationexpires' => 'Accountvacationexpires',
            'accountvacationexpiredate' => 'Accountvacationexpiredate',
            'accountpersonfirstname' => 'Accountpersonfirstname',
            'accountpersonlastname' => 'Accountpersonlastname',
        ];
    }

    /**
    * Relasi dengan Mail Account Profile
    */
    public function getProfile()
    {
        $model = MailAccountProfile::find()
                    ->where(['account_id'=>$this->accountid])
                    ->one();
        return $model;
    }

    public function getStatus()
    {
        switch ($this->accountactive) {
            case 1:
                $label = "<label class='label label-success'>Aktif</label>";
                break;
            
            default:
                $label = "<label class='label label-danger'>Non-Aktif</label>";
                break;
        }

        return $label;
    }

    /**
     * Hapus account mail and profile and folder
     */
    public function hapus()
    {
        MailAccountProfile::deleteAll('account_id='.$this->accountid);
        MailFolders::deleteAll('folderaccountid='.$this->accountid);
        $this->delete();
    }

    public function sendMail($status_mail){
        if($profile = $this->getProfile()){
            if($status_mail==1){
                $subject = "Akun Email Disperindag Jatim Telah Aktif";
                $body = "Akun email Disperindag Jatim Anda ".$this->accountaddress." telah diaktifkan. 
                        Untuk login email silahkan <a target='blank' href='http://disperindag.jatimprov.go.id/mail'>klik link berikut.</a> <br>
                        Anda juga sudah bisa masuk aplikasi mobile disperindag dengan akun ini<br>
                        <a target='blank' href='https://play.google.com/store/apps/details?id=gov.id.disperindag.disperindag_jatim_mobile'>Download aplikasi disperidag</a>";
            }else if($status_mail==0){
                $subject = "Akun Email Disperindag Jatim Non-Aktif";
                $body = "Akun email Disperindag Jatim anda telah di <b>Non-Aktifkan</b> oleh admin, lebih detail silahkan anda menghubungi admin.";
            }
            
            Yii::$app->mailer->compose()
                    ->setFrom('ppid.disperindagjatim@gmail.com')
                    ->setTo($profile->email_alternatif)
                    ->setSubject($subject)
                    ->setHtmlBody($body)
                    ->send();
        }
    }
}
