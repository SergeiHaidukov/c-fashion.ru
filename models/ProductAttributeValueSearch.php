<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProductAttributeValue;

/**
 * ProductAttributeValueSearch represents the model behind the search form about `app\models\ProductAttributeValue`.
 */
class ProductAttributeValueSearch extends ProductAttributeValue
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_pav', 'id_pat', 'parent'], 'integer'],
            [['value_pav'], 'safe'],
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
        $query = ProductAttributeValue::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_pav' => $this->id_pav,
            'id_pat' => $this->id_pat,
            'parent' => $this->parent,
        ]);

        $query->andFilterWhere(['like', 'value_pav', $this->value_pav]);

        return $dataProvider;
    }
}
