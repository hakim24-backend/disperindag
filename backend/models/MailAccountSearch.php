<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MailAccount;

/**
 * MailAccountSearch represents the model behind the search form about `common\models\MailAccount`.
 */
class MailAccountSearch extends MailAccount
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['accountid', 'accountdomainid', 'accountadminlevel', 'accountactive', 'accountisad', 'accountmaxsize', 'accountvacationmessageon', 'accountpwencryption', 'accountforwardenabled', 'accountforwardkeeporiginal', 'accountenablesignature', 'accountvacationexpires'], 'integer'],
            [['accountaddress', 'accountpassword', 'accountaddomain', 'accountadusername', 'accountvacationmessage', 'accountvacationsubject', 'accountforwardaddress', 'accountsignatureplaintext', 'accountsignaturehtml', 'accountlastlogontime', 'accountvacationexpiredate', 'accountpersonfirstname', 'accountpersonlastname'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = MailAccount::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['accountid'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'accountid' => $this->accountid,
            'accountdomainid' => $this->accountdomainid,
            'accountadminlevel' => $this->accountadminlevel,
            'accountactive' => $this->accountactive,
            'accountisad' => $this->accountisad,
            'accountmaxsize' => $this->accountmaxsize,
            'accountvacationmessageon' => $this->accountvacationmessageon,
            'accountpwencryption' => $this->accountpwencryption,
            'accountforwardenabled' => $this->accountforwardenabled,
            'accountforwardkeeporiginal' => $this->accountforwardkeeporiginal,
            'accountenablesignature' => $this->accountenablesignature,
            'accountlastlogontime' => $this->accountlastlogontime,
            'accountvacationexpires' => $this->accountvacationexpires,
            'accountvacationexpiredate' => $this->accountvacationexpiredate,
        ]);

        $query->andFilterWhere(['like', 'accountaddress', $this->accountaddress])
            ->andFilterWhere(['like', 'accountpassword', $this->accountpassword])
            ->andFilterWhere(['like', 'accountaddomain', $this->accountaddomain])
            ->andFilterWhere(['like', 'accountadusername', $this->accountadusername])
            ->andFilterWhere(['like', 'accountvacationmessage', $this->accountvacationmessage])
            ->andFilterWhere(['like', 'accountvacationsubject', $this->accountvacationsubject])
            ->andFilterWhere(['like', 'accountforwardaddress', $this->accountforwardaddress])
            ->andFilterWhere(['like', 'accountsignatureplaintext', $this->accountsignatureplaintext])
            ->andFilterWhere(['like', 'accountsignaturehtml', $this->accountsignaturehtml])
            ->andFilterWhere(['like', 'accountpersonfirstname', $this->accountpersonfirstname])
            ->andFilterWhere(['like', 'accountpersonlastname', $this->accountpersonlastname]);

        return $dataProvider;
    }
}
