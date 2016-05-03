<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Profile;

/**
 * ProfileSearch represents the model behind the search form about `frontend\models\Profile`.
 */
class ProfileSearch extends Profile
{
    public $genderName;
    public $gender_id;
    public $userId;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'gender_id'], 'integer'],
            [['first_name', 'last_name', 'birthdate', 'genderName', 'userId'], 'safe'],
        ];
    }
    
    public function attributeLabels() {
        return [
            'gender_id' => 'Gender',
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
        $query = Profile::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'id',
                'first_name',
                'last_name',
                'birthdate',
                'genderName' => [
                    'asc' => ['gender.gender_name' => SORT_ASC],
                    'desc' => ['gender.gender_name' => SORT_DESC],
                    'label' => 'Gender'
                ],
                'profileIdLink' => [
                    'asc' => ['profile.id' => SORT_ASC],
                    'desc' => ['Profile.id' => SORT_DESC],
                    'label' => 'ID'
                ],
                'userLink' => [
                    'asc' => ['user.user_name' => SORT_ASC],
                    'desc' => ['user.user_name' => SORT_DESC],
                    'label' => 'User'
                ],
            ]
        ]);

        if (!($this->load($params)) && $this->validate()) {
            $query->joinWith('gender')
                    ->joinWith('user');

            return $dataProvider;
        }
        
        $this->addSearchParameter($query, 'id');
        $this->addSearchParameter($query, 'first_name', true);
        $this->addSearchParameter($query, 'last_name', true);
        $this->addSearchParameter($query, 'birthdate');
        $this->addSearchParameter($query, 'gender_id');
        $this->addSearchParameter($query, 'created_at');
        $this->addSearchParameter($query, 'updated_at');
        $this->addSearchParameter($query, 'user_id');
        
        $query->joinWith(['gender' => function ($q) {
            $q->andFilterWhere(['=', 'gender.gender_name', $this->genderName]);
        }])
        ->joinWith(['user' => function ($q) {
            $q->andFilterWhere(['=', 'user.id', $this->user]);
        }]);

        return $dataProvider;
    }
    
    protected function addSearchParameter($query, $attribute, $patialMatch = false) {
        $pos = strrpos($attribute, '.');
        if ($pos !== false) {
            $modelAttribute = substr($attribute, $pos+1);
        } else {
            $modelAttribute = $attribute;
        }
        
        $value = $this->$modelAttribute;
        
        if(trim($value) === '') {
            return;
        }
        
        $attribute = "profile.$attribute";
        
        if ($patialMatch) {
            $query->andWhere(['like', $attribute, $value]);
        } else {
            $query->andWhere([$attribute => $value]);
        }
    }
}
