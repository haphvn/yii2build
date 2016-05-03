<?php
namespace frontend\controllers;

use common\models\Auth;
use common\models\LoginForm;
use common\models\User;
use frontend\models\ContactForm;
use frontend\models\EntryFrom;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use Yii;
use yii\base\InvalidParamException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{
    private $attributes = [];
    private $username;
    private $source;
    private $socialUser;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onAuthSuccess'],
            ]
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin($viaSocial = false)
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        if ($viaSocial) {
            Yii::$app->user->login($this->socialUser);
        } else {
            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                return $this->goBack();
            } else {
                return $this->render('login', [
                    'model' => $model,
                ]);
            }
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSignup($viaSocial = false)
    {
        if ($viaSocial) {
            if ($this->emailPresent() && $this->emailAlreadyInUse()) {
                return Yii::$app->getSession()->setFlash('error', [
                    Yii::t('app', "User with the same email as in {source} account already exists but ins't synced. Login with username and password and click the {source} sync link to sync accounts.", ['source' => $this->source]),
                ]);
            } else {
                $user = $this->createUser();
                $transaction = $user->getDb()->beginTransaction();
                if ($user->save()) {
                    $auth = $this->createAuth($user);
                    if ($auth->save()) {
                        $transaction->commit();
                        Yii::$app->user->login($user);
//
                    } else {
                        return Yii::$app->getSession()->setFlash('error', [
                            Yii::t('app', "We were unable to complete the process and sync {source}.", ['source' => $this->source]),
                        ]);
                    }
                } else {
                    if (User::find()->where(['username' => $this->username])) {
                        return Yii::$app->getSession()->setFlash('error', [
                            Yii::t('app', "Username already taken, please signup through the site Signup form and use a different username, thanks.", ['source' => $this->source]),
                        ]);
                    }
                }
            }
        } else {
            $model = new SignupForm();
            if ($model->load(Yii::$app->request->post())) {
                if ($user = $model->signup()) {
                    if (Yii::$app->getUser()->login($user)) {
                        return $this->goHome();
                    }
                }
            }

            return $this->render('signup', [
                'model' => $model,
            ]);
        }
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function onAuthSuccess($client)
    {
        $this->attributes = $client->getUserAttributes();
//        var_dump($client); die;

        $this->source = $client->getId();

        $this->formatProviderResponse($this->source);

        if (!$this->emailPresent()) {
            return Yii::$app->getSession()->setFlash('error', [
                Yii::t('app', "Unable to finish, {source} did not provide us with an email. Please check your settings on {source}.", ['source' => $this->source]),
            ]);
        }

        $existingAuth = $this->findExistingAuth();

        if (Yii::$app->user->isGuest) {
            if ($existingAuth) { // login steps
                $this->socialUser = $existingAuth->user;
                $viaSocial = true;
                $this->actionLogin($viaSocial);
            } else { // signup steps
                $viaSocial = true;
                $this->actionSignup($viaSocial);
            }
        } else { // user already logged in
            if (!$existingAuth && $this->matchEmail()) { // add auth provider
                $auth = $this->createAuth(Yii::$app->user);
                $auth->save();
                Yii::$app->getSession()->setFlash('error', [
                    Yii::t('app', "Your {source} account successfully synced.", ['source' => $this->source]),
                ]);
            } else { // email don't match
                if (!$this->matchEmail()) {
                    Yii::$app->getSession()->setFlash('error', [
                        Yii::t('app', "Your {source} account could not be synced.", ['source' => $this->source]),
                    ]);
                } else { // account was already synced
                    Yii::$app->getSession()->setFlash('error', [
                        Yii::t('app', "Your {source} account already synced.", ['source' => $this->source]),
                    ]);
                }
            }
        }
    }

    private function createUser()
    {
        $password = Yii::$app->security->generateRandomString(6);
        $user = new User([
            'username' => $this->attributes[$this->username],
            'email' => $this->attributes['email'],
            'password' => $password,
        ]);
        $user->generateAuthKey();
        return $user;
    }

    private function createAuth($user)
    {
        $auth = new Auth([
            'user_id' => $user->id,
            'source' => $this->source,
            'source_id' => (string)$this->attributes['id'],
        ]);
        return $auth;
    }

    private function findExistingAuth()
    {
        $auth = Auth::find()->where([
            'source' => $this->source,
            'source_id' => $this->attributes['id'],
        ])->one();
        return $auth;
    }

    private function emailPresent()
    {
        return isset($this->attributes['email']) ? true : false;
    }

    private function matchEmail()
    {
        return $this->attributes['email'] == Yii::$app->user->identity->email ? true : false;
    }

    private function formatProviderResponse($source)
    {
        switch ($source) {
            case $source == 'facebook' :
                $this->username = 'name';
                break;
            case $source == 'google' :
                $this->username = 'displayName';
                $emails = $this->attributes['emails'];
                foreach ($emails as $email) {
                    foreach ($email as $k => $v) {
                        if ($k == 'value') {
                            $this->attributes['email'] = $v;
                        }
                    }
                }
                break;
            default :
                $this->username = 'name';
        }
    }

    private function emailAlreadyInUse()
    {
        return User::find()
            ->where(['email' => $this->attributes['emails']])
            ->exists() ? true : false;
    }

    public function actionEntry()
    {
       $model = new EntryFrom();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // valid data received in $model
            // do something meaningful here about $model ...
            return $this->render('entry-confirm', ['model' => $model]);
        } else {
            // either the page is initially displayed or there is some validation error
            return $this->render('entry', ['model' => $model]);
        }
    }
}
