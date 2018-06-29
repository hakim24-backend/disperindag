<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Contact;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    // public $verifyCode;
    public $reCaptcha;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            // ['verifyCode', 'captcha'],
            // [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator::className(), 'secret' => '6LeIaRIUAAAAAOfJoZWDBYYGbJ-SowKqiEt5RAaO']
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
            'body' => 'Pesan',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param  string  $email the target email address
     * @return boolean whether the email was sent
     */
    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();
    }

    public function saveAs()
    {
        $model = new Contact();
        $model->nama = $this->name;
        $model->email = $this->email;
        $model->subjek = $this->subject;
        $model->tanggal = date('Y-m-d',time());
        $model->pesan = $this->body;
        $model->tampilkan = 'Y';
        return $model->save();
    }
}
