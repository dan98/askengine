<?php

class QuestionController extends Controller
{
        const STATUS_NEW = 0;
        const STATUS_RESPONDED = 1;
        const STATUS_IGNORED = 2;
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete, ignore', // we only allow deletion via POST request
                        'iAmTheReceiver + respond, ignore, delete'
		);
	}
        
        public function filterIAmTheReceiver($filterChain){
            if(!Yii::app()->user->checkAccess('iAmTheReceiver', array('id' => $_GET['id'])))
                throw new CHttpException(403,'Cant perform this action.');
            $filterChain->run();
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('new','ignored','create','respond','ignore', 'delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
        
        public function actionNew()
        {
            $dataProvider=new CActiveDataProvider('Question', array(
                'criteria'=>array(
                    'condition' => 'status = :status AND to_id = :to_id',
                    'order' => 'created_time DESC',
                    'params' => array(':status'=>self::STATUS_NEW, ':to_id'=>Yii::app()->user->id)
                ),
                'pagination'=>array(
                    'pageSize'=>10,
                ),
            ));

            $this->render('new',array(
                'dataProvider'=>$dataProvider
            ));
            
        }
        public function actionIgnored()
        {
            $dataProvider=new CActiveDataProvider('Question', array(
                'criteria'=>array(
                    'condition' => 'status = :status AND to_id = :to_id',
                    'order' => 'created_time DESC',
                    'params' => array(':status'=>self::STATUS_IGNORED, ':to_id'=>Yii::app()->user->id)
                ),
                'pagination'=>array(
                    'pageSize'=>10,
                ),
            ));

            $this->render('ignored',array(
                'dataProvider'=>$dataProvider
            ));
            
        }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Question;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Question']))
		{
                        $model->attributes=$_POST['Question'];
                        
                        $user = User::model()->findByPk($model->to_id);
                        if(empty($user))
                            throw new CHttpException(403,'Unexistent user.');

                        $model->setAttribute('from_id', Yii::app()->user->id);
                        $model->setAttribute('status', 0);
                        $model->setAttribute('hide', 0);
			
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
	public function actionRespond($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Question']))
		{
			$model->attributes=$_POST['Question'];
                        $model->setAttribute('status', 1);
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
                }
		$this->render('respond',array(
			'model'=>$model
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
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('question/'));
	}
        /**
	 * Ignores the question by attributing it the status STATUS_IGNORED;
	 */
	public function actionIgnore($id)
	{
                    $model = Question::model()->findByPk($id);
                    $model->scenario = 'status';
                    $model->status = 2;
                    $model->save();
                    if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('question/'));
        }

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Question');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Question the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Question::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Question $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='question-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
