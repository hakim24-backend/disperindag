<?php 
namespace frontend\components;

use Yii;
use common\models\HalamanProfil;

class MenuClass extends \yii\base\Component{
    
    public function init() {
    	$menu_profil = HalamanProfil::find()
    					->select('judul')
    					->all();
    	
    }

}