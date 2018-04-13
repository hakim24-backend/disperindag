<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "hm_imapfolders".
 *
 * @property integer $folderid
 * @property string $folderaccountid
 * @property integer $folderparentid
 * @property string $foldername
 * @property integer $folderissubscribed
 * @property string $foldercreationtime
 * @property string $foldercurrentuid
 */
class MailFolders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hm_imapfolders';
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
            [['folderaccountid', 'folderparentid', 'foldername', 'folderissubscribed', 'foldercreationtime', 'foldercurrentuid'], 'required'],
            [['folderaccountid', 'folderparentid', 'folderissubscribed', 'foldercurrentuid'], 'integer'],
            [['foldercreationtime'], 'safe'],
            [['foldername'], 'string', 'max' => 255],
            [['folderaccountid', 'folderparentid', 'foldername'], 'unique', 'targetAttribute' => ['folderaccountid', 'folderparentid', 'foldername'], 'message' => 'The combination of Folderaccountid, Folderparentid and Foldername has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'folderid' => 'Folderid',
            'folderaccountid' => 'Folderaccountid',
            'folderparentid' => 'Folderparentid',
            'foldername' => 'Foldername',
            'folderissubscribed' => 'Folderissubscribed',
            'foldercreationtime' => 'Foldercreationtime',
            'foldercurrentuid' => 'Foldercurrentuid',
        ];
    }
}
