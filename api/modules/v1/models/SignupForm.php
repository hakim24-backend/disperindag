<?php
namespace app\modules\v1\models;

use app\modules\v1\models\MemberMobile;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $nama;
    public $no_telp;
    public $gender;
    public $alamat;
    public $email;
    public $password;
    public $tanggal_lahir;
    public $instansi;
    
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama', 'email', 'gender', 'alamat', 'no_telp', 'tanggal_lahir', 'instansi'], 'required'],
            ['nama', 'filter', 'filter' => 'trim'],
            ['nama', 'string', 'max' => 30],
            
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => 'app\modules\v1\models\MemberMobile', 'message' => 'This email address has already been taken.'],

            ['no_telp', 'string', 'min' => 6, 'max' => 15]
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new MemberMobile();
        $user->nama     = $this->nama;
        $user->alamat   = $this->alamat;
        $user->gender   = $this->gender;
        $user->no_telp  = $this->no_telp;
        $user->email    = $this->email;
        $user->tanggal_lahir = $this->tanggal_lahir;
        $user->instansi = $this->instansi;
        
        return $user->save() ? $user : null;
    }
}
