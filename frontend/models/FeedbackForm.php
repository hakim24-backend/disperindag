<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Feedback;

/**
 * ContactForm is the model behind the contact form.
 */
class FeedbackForm extends Model
{
    public $nama;
    public $email;
    public $subject;
    public $feedback;
    // public $verifyCode;
    public $reCaptcha;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['nama', 'email', 'subject', 'feedback'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            // ['verifyCode', 'captcha'],
            [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator::className(), 'secret' => '6LeIaRIUAAAAAOfJoZWDBYYGbJ-SowKqiEt5RAaO']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            // 'verifyCode' => 'Verification Code',
            'name' => 'Nama',
            'email' => 'Email',
            'subject' => 'Subjek',
            'feedback' => 'Pesan',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param  string  $email the target email address
     * @return boolean whether the email was sent
     */

    public function saveAs()
    {
        $model = new Feedback();
        $model->nama = $this->nama;
        $model->email = $this->email;
        $model->subject = $this->subject;
        $model->tanggal = date('Y-m-d');
        $model->feedback = $this->feedback;
        $model->seen = 0;
        return $model->save();
    }
}
