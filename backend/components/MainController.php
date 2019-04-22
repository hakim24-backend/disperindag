<?php
namespace backend\components;

use Yii;
use common\models\Contact;
use backend\models\MemberMobile;
use common\models\Agenda;
use common\models\MailAccountProfile;
use common\models\Industri;

/**
* class parent controller
*/
class MainController extends \yii\web\Controller
{
    public function init() {
      parent::init();
    }

    /**
    * Untuk data yang selalu dipanggil disetiap halaman website
    * @param $content
    * @return mixed
    */
    public function renderContent($content)
    {
      $new['bukutamu'] = Contact::find()->where(['seen'=>0])->orderBy(['id_hubungi'=>SORT_DESC])->all();
      $new['member'] = MemberMobile::find()->where(['seen'=>0])->orderBy(['id'=>SORT_DESC])->all();
      $new['mailAccount'] = MailAccountProfile::find()->where(['seen'=>0])->orderBy(['id'=>SORT_DESC])->all();
      $new['agenda'] = Agenda::find()->where(['seen'=>0])->orWhere(['seen'=>2])->orderBy(['id_agenda'=>SORT_DESC])->all();
      $new['industri'] = Industri::find()->where(['status'=>0])->orderBy(['id'=>SORT_DESC])->all();

      $layoutFile = $this->findLayoutFile($this->getView());
        if ($layoutFile !== false) {
            return $this->getView()->renderFile($layoutFile, [
            	'content'           => $content,
              'notif_new'         => $new,
            ], $this);
        } else {
            return $content;
        }
    }

    /**
    * Membuat url slug
    * @param string $text (judul dari content)
    * @return string
    */
    static public function makeSlug($text)
    {
      $text = preg_replace('~[^\pL\d]+~u', '-', $text);
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
      $text = preg_replace('~[^-\w]+~', '', $text);
      $text = trim($text, '-');
      $text = preg_replace('~-+~', '-', $text);
      $text = strtolower($text);

      if (empty($text))
        return 'n-a';
      
      return $text;
    }

}