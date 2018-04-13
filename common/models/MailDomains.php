<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "hm_domains".
 *
 * @property integer $domainid
 * @property string $domainname
 * @property integer $domainactive
 * @property string $domainpostmaster
 * @property integer $domainmaxsize
 * @property string $domainaddomain
 * @property integer $domainmaxmessagesize
 * @property integer $domainuseplusaddressing
 * @property string $domainplusaddressingchar
 * @property integer $domainantispamoptions
 * @property integer $domainenablesignature
 * @property integer $domainsignaturemethod
 * @property string $domainsignatureplaintext
 * @property string $domainsignaturehtml
 * @property integer $domainaddsignaturestoreplies
 * @property integer $domainaddsignaturestolocalemail
 * @property integer $domainmaxnoofaccounts
 * @property integer $domainmaxnoofaliases
 * @property integer $domainmaxnoofdistributionlists
 * @property integer $domainlimitationsenabled
 * @property integer $domainmaxaccountsize
 * @property string $domaindkimselector
 * @property string $domaindkimprivatekeyfile
 */
class MailDomains extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hm_domains';
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
            [['domainname', 'domainactive', 'domainpostmaster', 'domainmaxsize', 'domainaddomain', 'domainmaxmessagesize', 'domainuseplusaddressing', 'domainplusaddressingchar', 'domainantispamoptions', 'domainenablesignature', 'domainsignaturemethod', 'domainsignatureplaintext', 'domainsignaturehtml', 'domainaddsignaturestoreplies', 'domainaddsignaturestolocalemail', 'domainmaxnoofaccounts', 'domainmaxnoofaliases', 'domainmaxnoofdistributionlists', 'domainlimitationsenabled', 'domainmaxaccountsize', 'domaindkimselector', 'domaindkimprivatekeyfile'], 'required'],
            [['domainactive', 'domainmaxsize', 'domainmaxmessagesize', 'domainuseplusaddressing', 'domainantispamoptions', 'domainenablesignature', 'domainsignaturemethod', 'domainaddsignaturestoreplies', 'domainaddsignaturestolocalemail', 'domainmaxnoofaccounts', 'domainmaxnoofaliases', 'domainmaxnoofdistributionlists', 'domainlimitationsenabled', 'domainmaxaccountsize'], 'integer'],
            [['domainsignatureplaintext', 'domainsignaturehtml'], 'string'],
            [['domainname', 'domainpostmaster'], 'string', 'max' => 80],
            [['domainaddomain', 'domaindkimselector', 'domaindkimprivatekeyfile'], 'string', 'max' => 255],
            [['domainplusaddressingchar'], 'string', 'max' => 1],
            [['domainname'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'domainid' => 'Domainid',
            'domainname' => 'Domainname',
            'domainactive' => 'Domainactive',
            'domainpostmaster' => 'Domainpostmaster',
            'domainmaxsize' => 'Domainmaxsize',
            'domainaddomain' => 'Domainaddomain',
            'domainmaxmessagesize' => 'Domainmaxmessagesize',
            'domainuseplusaddressing' => 'Domainuseplusaddressing',
            'domainplusaddressingchar' => 'Domainplusaddressingchar',
            'domainantispamoptions' => 'Domainantispamoptions',
            'domainenablesignature' => 'Domainenablesignature',
            'domainsignaturemethod' => 'Domainsignaturemethod',
            'domainsignatureplaintext' => 'Domainsignatureplaintext',
            'domainsignaturehtml' => 'Domainsignaturehtml',
            'domainaddsignaturestoreplies' => 'Domainaddsignaturestoreplies',
            'domainaddsignaturestolocalemail' => 'Domainaddsignaturestolocalemail',
            'domainmaxnoofaccounts' => 'Domainmaxnoofaccounts',
            'domainmaxnoofaliases' => 'Domainmaxnoofaliases',
            'domainmaxnoofdistributionlists' => 'Domainmaxnoofdistributionlists',
            'domainlimitationsenabled' => 'Domainlimitationsenabled',
            'domainmaxaccountsize' => 'Domainmaxaccountsize',
            'domaindkimselector' => 'Domaindkimselector',
            'domaindkimprivatekeyfile' => 'Domaindkimprivatekeyfile',
        ];
    }
}
