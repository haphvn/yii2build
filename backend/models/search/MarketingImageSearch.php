<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MarketingImage;

/**
 * MarketingImageSearch represents the model behind the search form about `backend\models\MarketingImage`.
 */
class MarketingImageSearch extends MarketingImage
{
    
    public $statusName;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'marketing_image_is_featured', 'marketing_image_is_active', 'marketing_image_weight', 'status_id'], 'integer'],
            [['marketing_image_path', 'marketing_image_name', 'marketing_image_caption', 'marketing_image_caption_title', 'created_at', 'statusName', 'updated_at'], 'safe'],
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
        $query = MarketingImage::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'marketing_image_is_featured' => $this->marketing_image_is_featured,
            'marketing_image_is_active' => $this->marketing_image_is_active,
            'marketing_image_weight' => $this->marketing_image_weight,
            'status_id' => $this->status_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'marketing_image_path', $this->marketing_image_path])
            ->andFilterWhere(['like', 'marketing_image_name', $this->marketing_image_name])
            ->andFilterWhere(['like', 'marketing_image_caption', $this->marketing_image_caption]);

        return $dataProvider;
    }
    
    public function addSearchParameter($query, $attribute, $partialMatch = false) 
    {
        if (($pos = strpos($attribute, '.')) !== false) {
            $modelAttribute = substr($attribute, $pos+1);
        } else {
            $modelAttribute = $attribute;
        }
        
        $value = $this->$modelAttribute;
        if (trim($value) === '') {
            return;
        }
        
        $attribute = 'marketing_image'.$attribute;
        if ($partialMatch) {
            $query->andWhere(['like', $attribute, $value]);
        } else {
            $query->andWhere([$attribute => $value]);
        }
    }
}
