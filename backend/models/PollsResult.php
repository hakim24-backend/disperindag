<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "polls_result".
 *
 * @property int $num № of answer (for multiple)
 * @property int $id_poll № of poll
 * @property int $id_answer № of answer
 * @property int $id_user
 * @property int $id
 * @property string $create_at
 * @property string $update_at
 * @property string $ip
 * @property string $host
 * @property int $id_berita
 *
 * @property PollsAnswers $answer
 * @property Polls $poll
 */
class PollsResult extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'polls_result';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['num', 'id_poll', 'id_answer', 'id_user', 'id_berita'], 'integer'],
            [['id_poll', 'id_answer', 'id_user', 'create_at', 'update_at', 'ip'], 'required'],
            [['create_at', 'update_at'], 'safe'],
            [['ip', 'host'], 'string', 'max' => 20],
            [['id_answer'], 'exist', 'skipOnError' => true, 'targetClass' => PollsAnswers::className(), 'targetAttribute' => ['id_answer' => 'id']],
            [['id_poll'], 'exist', 'skipOnError' => true, 'targetClass' => Polls::className(), 'targetAttribute' => ['id_poll' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'num' => 'Num',
            'id_poll' => 'Id Poll',
            'id_answer' => 'Id Answer',
            'id_user' => 'Id User',
            'id' => 'ID',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
            'ip' => 'Ip',
            'host' => 'Host',
            'id_berita' => 'Id Berita',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswer()
    {
        return $this->hasOne(PollsAnswers::className(), ['id' => 'id_answer']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPoll()
    {
        return $this->hasOne(Polls::className(), ['id' => 'id_poll']);
    }
}
