<?php

namespace common\models;

use Yii;
use backend\components\MainModel;

/**
 * This is the model class for table "video".
 *
 * @property integer $id_video
 * @property string $jdl_video
 * @property string $url
 * @property string $gambar
 * @property string $tgl_posting
 */
class Video extends MainModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'video';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jdl_video', 'url'], 'required'],
            ['jdl_video','unique'],
            ['jdl_video', 'string', 'max' => 100],
            ['url', 'url'],
            ['url', 'checkYoutube'],
        ];
    }

    public function checkYoutube($attribute,$params)
    {
        if(!$this->hasErrors()){
            $rx = '~
                ^(?:https?://)?              # Optional protocol
                 (?:www\.)?                  # Optional subdomain
                 (?:youtube\.com|youtu\.be)  # Mandatory domain name
                 /watch\?v=([^&]+)           # URI with video id as capture group 1
                 ~x';

            $has_match = preg_match($rx, $this->url, $matches);
            if(!$has_match)
                $this->addError($attribute, 'Video harus berasal dari youtube');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_video' => 'Id Video',
            'jdl_video' => 'Judul Video',
            'url' => 'Url',
            'gambar' => 'Gambar',
            'tgl_posting' => 'Tgl Posting',
        ];
    }

    public function simpan()
    {
        if($this->validate()){
            if($this->isNewRecord){
                $this->tgl_posting = date("Y-m-d");
                $this->username = Yii::$app->user->identity->username;
            }
            $this->slug = $this->makeSlug($this->jdl_video);
            $this->save();
            return true;
        }
        return false;
    }

    public function getIdYoutubeVideo()
    {
        return explode("v=", $this->url)[1];
    }
}
