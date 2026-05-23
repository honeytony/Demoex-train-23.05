<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Requests;
use Yii;

/**
 * RequestsSearch represents the model behind the search form of `app\models\Requests`.
 */
class RequestsSearch extends Requests
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'ship_id', 'payment_id', 'user_id', 'status_id'], 'integer'],
            [['startdate'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Requests::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        // Если не админ, видит только свои заявки
        if(Yii::$app->user->identity->isadmin === 0) {        
            $query->andFilterWhere([
                'user_id' => Yii::$app->user->identity->id
            ]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'ship_id' => $this->ship_id,
            'startdate' => $this->startdate,
            'payment_id' => $this->payment_id,
            'user_id' => $this->user_id,
            'status_id' => $this->status_id,
        ]);

        return $dataProvider;
    }
}
