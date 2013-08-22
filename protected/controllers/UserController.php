<?php

class UserController extends Controller
{
    const USER_ADMIN = 2;
    const USER_MODER = 1;
    const USER_SIMPLE = 0;
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
        
        private $_identity;

	/**
	 * @return array action filters
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
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('view', 'create', 'login'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update', 'logout', 'delete', 'index', 'avatar'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	/**
	 * Displays the login page
	 */
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

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
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
                        
			if($q->save())
				$this->redirect(array('view','id'=>$id));
		}
                
                $criteria = new CDbCriteria;
                $criteria->params = array(':id'=>$id);
                $criteria->condition = 'to_id=:id';
                $criteria->order = 'updated_time Desc';
                $criteria->with = Yii::app()->user->isGuest ? array('likes') : array('likes', 'liked');
                $criteria->scopes = array('showed', 'responded');
		$dataProvider=new CActiveDataProvider('Question', array(
                    'criteria'=>$criteria,
                    'pagination'=>array(
                        'pageSize'=>10,
                    ),
                ));
                
                // Render
		$this->render('view',array(
			'model'=>$this->loadModel($id),
                        'questions'=>$dataProvider,
                        'q'=>$q
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
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

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
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

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionFollowers($id = null)
	{
                if($id == null && Yii::app()->user->isGuest == true){
                    $this->redirect(array('user/login'));
                }else if($id == null && Yii::app()->user->isGuest == false){
                    $id = Yii::app()->user->id;
                }
                $dataProvider = User::model()->findByPk($id)->followers;
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
        
        
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
