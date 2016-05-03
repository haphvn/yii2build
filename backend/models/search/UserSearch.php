<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\User;

/**
 * UserSearch represents the model behind the search form about `common\models\User`.
 */
class UserSearch extends User {

    public $roleName;
    public $userTypeName;
    public $user_type_name;
    public $user_type_id;
    public $statusName;
    public $profileId;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'role_id', 'status_id', 'user_type_id'], 'integer'],
            [['username', 'email', 'created_at', 'updated_at', 'roleName', 'statusName', 'userTypeName', 'profileId', 'user_type_name'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'id',
                'userIdLink' => [
                    'asc' => ['user.id' => SORT_ASC],
                    'desc' => ['user.id' => SORT_DESC],
                    'label' => 'User'
                ],
                'userLink' => [
                    'asc' => ['user.id' => SORT_ASC],
                    'desc' => ['user.id' => SORT_DESC],
                    'label' => 'User'
                ],
                'profileLink' => [
                    'asc' => ['profile.id' => SORT_ASC],
                    'desc' => ['profile.id' => SORT_DESC],
                    'label' => 'Profile'
                ],
                'roleName' => [
                    'asc' => ['role.role_name' => SORT_ASC],
                    'desc' => ['role.role_name' => SORT_DESC],
                    'label' => 'Role'
                ],
                'statusName' => [
                    'asc' => ['status.status_name' => SORT_ASC],
                    'desc' => ['status.status_name' => SORT_DESC],
                    'label' => 'Status'
                ],
                'userTypeName' => [
                    'asc' => ['user_type.user_type_name' => SORT_ASC],
                    'desc' => ['user_type.user_type_name' => SORT_DESC],
                    'label' => 'User Type'
                ],
                'created_at' => [
                    'asc' => ['created_at.id' => SORT_ASC],
                    'desc' => ['created_at.id' => SORT_DESC],
                    'label' => 'Created At'
                ],
                'email' => [
                    'asc' => ['Email.id' => SORT_ASC],
                    'desc' => ['Email.id' => SORT_DESC],
                    'label' => 'Email'
                ],
            ]
        ]);

        if (!($this->load($params)) && $this->validate()) {
            $query->joinWith('role')
                    ->joinWith('status')
                    ->joinWith('profile')
                    ->joinWith('userType');

            return $dataProvider;
        }
        
        $this->addSearchParameter($query, 'id', true);
        $this->addSearchParameter($query, 'username', true);
        $this->addSearchParameter($query, 'email', true);
        $this->addSearchParameter($query, 'role_id');
        $this->addSearchParameter($query, 'status_id');
        $this->addSearchParameter($query, 'user_type_id');
        $this->addSearchParameter($query, 'created_at');
        $this->addSearchParameter($query, 'updated_at');
        
        $query->joinWith(['role' => function ($q) {
            $q->andFilterWhere(['=', 'role.role_name', $this->roleName]);
        }])
        ->joinWith(['status' => function ($q) {
            $q->andFilterWhere(['=', 'status.status_name', $this->statusName]);
        }])
        ->joinWith(['userType' => function ($q) {
            $q->andFilterWhere(['=', 'user_type.user_type_name', $this->userTypeName]);
        }])
        ->joinWith(['profile' => function ($q) {
            $q->andFilterWhere(['=', 'profile.id', $this->profileId]);
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
        
        $attribute = "user.$attribute";
        
        if ($patialMatch) {
            $query->andWhere(['like', $attribute, $value]);
        } else {
            $query->andWhere([$attribute => $value]);
        }
    }

}
