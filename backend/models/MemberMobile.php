<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "member_mobile".
 *
 * @property integer $id
 * @property string $nama
 * @property string $gender
 * @property string $alamat
 * @property string $no_telp
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class MemberMobile extends \yii\db\ActiveRecord
{
    public $status_before;
    private $new_password;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'member_mobile';
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
            [['nama', 'gender', 'email','no_telp', 'status'], 'required'],
            [['status'], 'integer'],
            [['nama'], 'string', 'max' => 30],
            [['gender'], 'string', 'max' => 1],
            [['alamat'], 'string', 'max' => 100],
            [['no_telp'], 'string', 'max' => 15],
            [['email'], 'email'],
            [['email'], 'unique'],
            ['password_hash', 'string', 'min' => 6],
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
            'gender' => 'Jenis Kelamin',
            'alamat' => 'Alamat',
            'no_telp' => 'No Telpon',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Member Sejak',
            'updated_at' => 'Diupdate pada',
        ];
    }

    public function getDate($timestamp)
    {
        return date("d M Y",$timestamp);
    }

    public function getStatus()
    {
        switch ($this->status) {
            case 10:
                $label = "<label class='label label-success'>Aktif</label>";
                break;
            
            default:
                $label = "<label class='label label-danger'>Non-Aktif</label>";
                break;
        }

        return $label;
    }

    /**
     * Update seen
     */
    public function seen()
    {
        if($this->seen == 0){
            $this->seen = 1;
            $this->save();
        }
    }

    public function simpan()
    {
        if($this->validate()){
            if($this->isNewRecord){
                $this->setPassword();
                $this->generateAuthKey();
            }else{
                if($this->status != $this->status_before){
                    if($this->status==10){
                        $this->new_password = Yii::$app->security->generateRandomString(8);
                        $this->password_hash = $this->new_password;
                        $this->setPassword();
                        $this->generateAuthKey();
                        $status_mail = 1;
                    }else if($this->status==0){
                        $status_mail = 0;
                    }
                }
            }
            if($this->save()){
                if($this->status != $this->status_before){
                    $this->sendMail($status_mail);
                }
                return true;
            }
        }
        return false;
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword()
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($this->password_hash);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function sendMail($status_mail){
        
        if($status_mail==1){
            $subject = "Akun User Mobile Disperindag Jatim Telah Aktif";
            $body = "Akun user mobile Disperindag Jatim Anda telah diaktifkan. 
                    Untuk login silahkan menggunakan email yang Anda daftarkan, dan password dibawah ini. <br>
                    <i><b>Password :</b> ".$this->new_password."</i><br><br>
                    <i>(Catatan:Dihimbau untuk menjaga kerahasiaan akun anda, setelah login diharapkan Anda mengganti password anda di menu profil)</i>";
        }else if($status_mail==0){
            $subject = "Akun User Mobile Disperindag Jatim Non-Aktif";
            $body = "Akun user mobile Disperindag Jatim anda telah di <b>Non-Aktifkan</b> oleh admin, lebih detail silahkan anda menghubungi admin.";
        }
        
        Yii::$app->mailer->compose()
                ->setFrom('ppid.disperindagjatim@gmail.com')
                ->setTo($this->email)
                ->setSubject($subject)
                ->setHtmlBody($body)
                ->send();
    }

    public static function activationByMail($email,$activation=0)
    {
        $memberData = MemberMobile::find()
                        ->where(['email'=>$email])
                        ->one();
        
        if($memberData){
            if($activation == 0)
                $memberData->status = 0;
            else
                $memberData->status = 10;
            $memberData->save();
            //print_r($memberData->errors);
        }
    }
}
