<?php

class UserController extends Controller
{
        const USER_ADMIN = 2;
        const USER_MODER = 1;
        const USER_SIMPLE = 0;
        
        private $_identity;

        /**
        * Returns.
        */
	public function filters()
	{
		return array(
			'postOnly + delete', // we only allow deletion via POST request
                        'mineOnly + update, delete',
                        'allowAnonym + view',
                        'accessControl',
		);
	}
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('view', 'create', 'login'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update', 'logout', 'following'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        
	public function actionLogin()
	{
		if (!defined('CRYPT_BLOWFISH')||!CRYPT_BLOWFISH)
			throw new CHttpException(500,"This application requires that PHP was compiled with Blowfish support for crypt().");

		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}
        
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	
	public function actionView($id = null)
	{
                // Redirect
                if($id == null && Yii::app()->user->isGuest == true){
                    $this->redirect(array('user/login'));
                }else if($id == null && Yii::app()->user->isGuest == false){
                    $id = Yii::app()->user->id;
                }
                
                // Question ActiveRecord
                $q=new Question('create');

		if(isset($_POST['Question']))
		{
                        if(Yii::app()->user->isGuest)
                            $this->redirect(array('user/login'));
                        
                        $q->to_id = $_POST['Question']['to_id'];
                        $q->question_text = $_POST['Question']['question_text'];
                        $q->from_id = Yii::app()->user->id;
                        $q->status = 0;
                        $q->hide = 0;
                        
                        if(isset($_POST['Question']['anonym']))
                        {
                            $q->anonym = $_POST['Question']['anonym'];
                            if($q->anonym == 2)
                                $q->anonym_custom = $_POST['Question']['anonym_custom'];
                        }
                        
			$q->save();
		}
                
                $criteria = new CDbCriteria;
                $criteria->params = array(':id'=>$id);
                $criteria->condition = 'to_id=:id';
                $criteria->order = 'updated_time DESC';
                $criteria->with = Yii::app()->user->isGuest ? array('likes') : array('likes', 'liked');
                $criteria->scopes = array('showed', 'responded');
		$dataProvider=new CActiveDataProvider('Question', array(
                    'criteria'=>$criteria,
                    'pagination'=>array(
                        'pageSize'=>10,
                    ),
                ));
                $user = $this->loadModel($id);
                $this->pageTitle = $user->firstname.' '.$user->lastname;
                // Render
		$this->render('view',array(
			'model'=>$user,
                        'questions'=>$dataProvider,
                        'q'=>$q
		));
                
	}

	public function actionCreate()
	{
		$model=new User('insert');

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save()){
				if($this->_identity===null)
                                {
                                        $this->_identity=new UserIdentity($_POST['User']['email'],$_POST['User']['password']);
                                        $this->_identity->authenticate();
                                }
                                if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
                                {
                                        $duration= 3600; // 30 days
                                        Yii::app()->user->login($this->_identity,$duration);
                                        $this->redirect('/');
                                }
                        }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

                $model->initialPassword = $model->password;
                $model->password = null;
		if(isset($_POST['User']))
		{       
			$model->attributes=$_POST['User'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
        public function actionFollowing($id = null)
	{
                if($id == null && Yii::app()->user->isGuest == true){
                    $this->redirect(array('user/login'));
                }else if($id == null && Yii::app()->user->isGuest == false){
                    $id = Yii::app()->user->id;
                }
		$this->render('following',array(
			'user'=>User::model()->findByPk($id),
		));
	}
        
        
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	protected function performAjaxValidation($model)
        {
            if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
        }
}
