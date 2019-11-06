<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Media;

/**
 * MediaSearch represents the model behind the search form of `common\models\Media`.
 */
class MediaSearch extends Media
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'album_id', 'file_size', 'link_shared', 'status', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['file_name', 'file_type', 'alt', 'slug'], 'safe'],
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
        $query = Media::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
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
            'album_id' => $this->album_id,
            'file_size' => $this->file_size,
            'link_shared' => $this->link_shared,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'file_name', $this->file_name])
            ->andFilterWhere(['like', 'file_type', $this->file_type])
            ->andFilterWhere(['like', 'alt', $this->alt])
            ->andFilterWhere(['like', 'slug', $this->slug]);

        return $dataProvider;
    }
}
