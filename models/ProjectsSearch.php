<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Projects;

/**
 * ProjectsSearch represents the model behind the search form of `app\models\Projects`.
 */
class ProjectsSearch extends Projects
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'moderator_status_setter_id', 'citizen_status_setter_id'], 'integer'],
            [['name', 'description', 'location_text', 'moderator_status', 'citizen_status', 'created_at', 'updated_at'], 'safe'],
            [['price', 'latitude', 'longitude'], 'number'],
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
        $query = Projects::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'price' => $this->price,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'moderator_status_setter_id' => $this->moderator_status_setter_id,
            'citizen_status_setter_id' => $this->citizen_status_setter_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'location_text', $this->location_text])
            ->andFilterWhere(['like', 'moderator_status', $this->moderator_status])
            ->andFilterWhere(['like', 'citizen_status', $this->citizen_status]);

        return $dataProvider;
    }
}
