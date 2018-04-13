<?php
namespace backend\models;

use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class UserForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $nama_lengkap;
    public $no_telp;
    public $status_blokir;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Username sudah ada.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Email sudah dipakai.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['nama_lengkap', 'string'],
            [['no_telp'], 'number','min'=>10],
            ['status_blokir', 'string'],
            [['nama_lengkap','status_blokir'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'status_blokir' => 'Status',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function create()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username     = $this->username;
        $user->email        = $this->email;
        $user->password     = md5($this->password);
        $user->nama_lengkap = $this->nama_lengkap;
        $user->no_telp      = $this->no_telp;
        $user->blokir       = $this->status_blokir;
        $user->setPassword($user->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}
