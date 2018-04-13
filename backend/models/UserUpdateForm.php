<?php
namespace backend\models;

use common\models\User;
use yii\base\Model;
use yii\web\NotFoundHttpException;
use Yii;

/**
 * Signup form
 */
class UserUpdateForm extends Model
{
    public $username;
    public $email;
    public $current_email;
    public $password;
    public $nama_lengkap;
    public $no_telp;
    public $status_blokir;
    public $user_model;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'checkEmailAvailable'],

            ['password', 'string', 'min' => 6],

            ['nama_lengkap', 'string'],
            ['no_telp', 'number'],
            ['status_blokir', 'string'],
            [['nama_lengkap','status_blokir'], 'required'],
        ];
    }

    /**
     * Validates the Email available or not.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function checkEmailAvailable($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = User::find()->where(['email'=>$this->email])->one();
            if ($user) {
                if($user->email != $this->current_email){
                    $this->addError($attribute, 'Email sudah dipakai');
                }
            }
        }
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

    public function loadData($username)
    {
        $this->user_model = $this->findModel($username);
        $this->username         = $this->user_model->username;
        $this->email            = $this->user_model->email;
        $this->current_email    = $this->user_model->email;
        $this->nama_lengkap     = $this->user_model->nama_lengkap;
        $this->no_telp          = $this->user_model->no_telp;
        $this->status_blokir    = $this->user_model->blokir;
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function update()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $this->user_model->email        = $this->email;
        $this->user_model->nama_lengkap = $this->nama_lengkap;
        $this->user_model->no_telp      = $this->no_telp;
        $this->user_model->blokir       = $this->status_blokir;

        if($this->password != ''){
            $this->user_model->password     = md5($this->password);
            $this->user_model->setPassword($this->user_model->password);
        }

        $this->user_model->generateAuthKey();
        
        return $this->user_model->save() ? $this->user_model : null;
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
