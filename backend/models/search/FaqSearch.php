<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Faq;
use yii\db\Query;
use yii\data\ArrayDataProvider;
use yii\data\SqlDataProvider;

/**
 * FaqSearch represents the model behind the search form about `backend\models\Faq`.
 */
class FaqSearch extends Faq
{
    
    public $faqCategoryName;
    public $faqCategoryList;
    public $faqIsFeaturedName;
    public $createdByUsername;
    public $updatedByUsername;
    public $faq_category;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'faq_category_id', 'faq_is_featured', 'faq_weight', 'created_by', 'updated_by'], 'integer'],
            [['faq_question', 'faq_answer', 'created_at', 'updated_at', 'faqCategoryName', 'faqCategoryList', 'faqIsFeaturedName', 'createdByUsername', 'updatedByUsername', 'faq_category', 'faq_weight'], 'safe'],
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
        $query = Faq::find();

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
            'faq_category_id' => $this->faq_category_id,
            'faq_is_featured' => $this->faq_is_featured,
            'faq_weight' => $this->faq_weight,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'faq_question', $this->faq_question])
            ->andFilterWhere(['like', 'faq_answer', $this->faq_answer]);

        return $dataProvider;
    }
    
    public function featuredProvider() {
//        $query = new Query;
//        $featuredProvider = new ArrayDataProvider([
//            'allModels' => $query->from('faq')->where(['faq_is_featured' => 1])->all(),
//            'sort' => [
//                'defaultOrder' => [
//                    'faq_weight' => SORT_ASC,
//                ]
//            ],
//            'attributes' => ['faq_question', 'faq_answer', 'faq_weight'],
//            'pagination' => [
//                'pageSize' => 10,
//            ],
//        ]);
        
        $count = \Yii::$app->db->createCommand('select count(*) from `faq` where `faq_is_featured` =: faq_is_featured', [':faq_is_featured' => 1])->queryScalar();
        
        $featuredProvider = new SqlDataProvider([
            'sql' => 'select * from `faq` where `faq_is_featured =: faq_is_featured order by `faq_weight` asc',
            'params' => [':faq_is_featured' => 1],
            'totalCount' => $count,
            'sort' => [
                'attributes' => [
                    'id',
                    'faq_question',
                ],
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        
        return $featuredProvider;
    }
}
