<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProductsTemplate;

/**
 * ProductsTemplateSearch represents the model behind the search form about `app\models\ProductsTemplate`.
 */
class ProductsTemplateSearch extends ProductsTemplate
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_prod_temp', 'id_product', 'id_color', 'id_size'], 'integer'],
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
        $query = ProductsTemplate::find();

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
            'id_prod_temp' => $this->id_prod_temp,
            'id_product' => $this->id_product,
            'id_color' => $this->id_color,
            'id_size' => $this->id_size,
        ]);

        return $dataProvider;
    }
}
