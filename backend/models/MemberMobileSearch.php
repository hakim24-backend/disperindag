<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MemberMobile;
use backend\models\DateTime;

/**
 * MemberMobileSearch represents the model behind the search form about `backend\models\MemberMobile`.
 */
class MemberMobileSearch extends MemberMobile
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['nama', 'gender', 'alamat', 'no_telp', 'auth_key', 'password_hash', 'password_reset_token', 'created_at', 'email'], 'safe'],
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
        $query = MemberMobile::find();

		//var_dump($query); die();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['seen'=>SORT_ASC,'id'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        
        $query->andFilterWhere([
            //'id' => $this->id,
            'status' => $this->status,
           // 'created_at' => $this->created_at,
            //'updated_at' => $this->updated_at,
        ]);
		
		if(!empty($this->created_at)){
			$time1 = strtotime(explode(' - ',$this->created_at)[0]);
			$time2 = strtotime(explode(' - ',$this->created_at)[1]);
			$dateStart =  date('Y-m-d',$time1);
			$dateEnd =  date('Y-m-d',$time2);
			
			$query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'no_telp', $this->no_telp])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
			->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email])
			->andFilterWhere(['between', 'FROM_UNIXTIME(created_at,"%Y-%m-%d")', $dateStart,$dateEnd ]);
		}else{
			
			$query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'no_telp', $this->no_telp])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email]);
			
		}

        

        return $dataProvider;
    }
}
