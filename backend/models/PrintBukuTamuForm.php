<?php
namespace backend\models;

use yii\base\Model;
use Yii;
use common\models\Contact;

/**
 * Signup form
 */
class PrintBukuTamuForm extends Model
{
    public $start_date;
    public $end_date;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start_date','end_date'], 'required'],
            [['end_date','start_date'], 'mustMoreThan'],
        ];
    }

    /**
     * Validates required textarea beacause this textarea is a tinymce.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function mustMoreThan($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if(strtotime($this->start_date) > strtotime($this->end_date))
                $this->addError($attribute, 'Tanggal akhir harus sesudah tanggal awal');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'start_date' => 'Dari Tanggal',
            'end_date' => 'Sampai Tanggal',
        ];
    }

    public function check()
    {
        if($this->validate()){
            return true;
        }
        return false;
    }

    public function getDataPrint()
    {
        $data = Contact::find()
                ->where("tanggal >= '".$this->start_date."' AND tanggal <= '".$this->end_date."'")
                ->all();
        return $data;
    }

}
