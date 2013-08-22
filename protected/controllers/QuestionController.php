<?php

class QuestionController extends Controller
{
        const STATUS_NEW = 0;
        const STATUS_RESPONDED = 1;
        const STATUS_IGNORED = 2;
        
        const ANONYM_TRUE = 1;
        const ANONYM_FALSE = 0;
        const ANONYM_CUSTOM = 2;
        
        const HIDE_TRUE = 1;
        const HIDE_FALSE = 0;
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
        public $defaultAction='feed';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete, ignore, show, hide', // we only allow deletion via POST request
                        'iAmTheReceiver + respond, ignore, delete, show, hide'
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
				'actions'=>array('view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('new','ignored','create','respond','ignore', 'delete', 'show', 'hide', 'hided','feed', 'likes'),
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
            // Question ActiveRecord
            $q=new Question('self');

            if(isset($_POST['Question']))
            {
                    if(Yii::app()->user->isGuest)
                        $this->redirect(array('user/login'));
                    print_r($_POST['Question']);
                    $q->attributes = $_POST['Question'];
                    $q->from_id = $q->to_id = Yii::app()->user->id;
                    $q->status = 1;
                    if(CUploadedFile::getInstance($q,'image'))
                        {
                            $uploadedFile = CUploadedFile::getInstance($q,'image');
                            $rnd = rand(0,9999);
                            $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
                            $q->image = $fileName;
                        }
                        if($q->hide != 1){
                            User::model()->addAnswer(Yii::app()->user->id);
                        }
                    if(isset($_POST['Question']['anonym']))
                    {
                        $q->anonym = $_POST['Question']['anonym'];
                        if($q->anonym == 2)
                            $q->anonym_custom = $_POST['Question']['anonym_custom'];
                    }

                    if($q->save()){
                         if(isset($uploadedFile))
                            {
                                $uploadedFile->saveAs(dirname(Yii::app()->getBasePath())."\images\\".$fileName);
                                Yii::import('ext.yii-easyimage.drivers.ImageKit');
                                $image = ImageKit::factory("images/".$fileName);
                                $image->resize(300, 300);
                                $image->save("images-thumb/".$fileName);
                            }
                            $this->redirect(array('/me'));
                    }
            }
            
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
                'dataProvider'=>$dataProvider,
                'q'=>$q
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
        public function actionHided()
        {
            $dataProvider=new EActiveDataProvider('Question', array(
                'scopes'=>array('hided', 'responded'),
                'criteria'=>array(
                    'condition' => 'to_id = :to_id',
                    'order' => 'created_time DESC',
                    'params' => array(':to_id'=>Yii::app()->user->id)
                ),
                'pagination'=>array(
                    'pageSize'=>10,
                ),
            ));

            $this->render('hided',array(
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
                        if($user->anonym_questions == 0 && $_POST['Question']['anonym'] != self::ANONYM_FALSE)
                            throw new CHttpException(403,'This user doesnt accept anonym questions.');
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

		if(isset($_POST['Question']))
		{
			$model->attributes=$_POST['Question'];
                        if(CUploadedFile::getInstance($model,'image'))
                        {
                            $uploadedFile = CUploadedFile::getInstance($model,'image');
                            $rnd = rand(0,9999);
                            $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
                            $model->image = $fileName;
                        }
                        $model->setAttribute('status', 1);
                        if($model->hide != 1){
                            User::model()->addAnswer(Yii::app()->user->id);
                        }
			if($model->save()){
                            if(isset($uploadedFile))
                            {
                                $uploadedFile->saveAs(dirname(Yii::app()->getBasePath())."\images\\".$fileName);
                                Yii::import('ext.yii-easyimage.drivers.ImageKit');
                                $image = ImageKit::factory("images/".$fileName);
                                $image->resize(300, 300);
                                $image->save("images-thumb/".$fileName);
                            }
                        }else
                            throw new CHttpException(500, 'Error');
                }
                if(!isset($_GET['ajax']))
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
		$model = $this->loadModel($id);
                if($model->status == self::STATUS_RESPONDED)
                    User::model()->substractAnswer($model->to_id);
                $model->delete();
                
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
                    $id = $model->id;
                    $model->save();
                    if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('question/'));
        }
        public function actionHide($id)
	{
                    $model = Question::model()->findByPk($id);
                    $model->scenario = 'hide';
                    if($model->hide == self::HIDE_FALSE){
                        $model->hide = self::HIDE_TRUE;
                        User::model()->substractAnswer($model->to_id);
                        $model->save();
                        if(!isset($_GET['ajax']))
                            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('question/'));
                        else
                            $url = Yii::app()->createAbsoluteUrl('question/show/', array('ajax'=>1, 'id'=>$model->id));
                            echo CHtml::link('show',$url, array('class'=>'show-link'));
                    }else
                        throw new CHttpException('400', 'This question is already hided');
        }
        public function actionShow($id)
	{
                    $model = Question::model()->findByPk($id);
                    $model->scenario = 'hide';
                    if($model->hide == self::HIDE_TRUE){
                        $model->hide = self::HIDE_FALSE;
                        User::model()->addAnswer($model->to_id);
                        $model->save();
                        if(!isset($_GET['ajax']))
                            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('question/'));
                        else
                            $url = Yii::app()->createAbsoluteUrl('question/hide/', array('ajax'=>1, 'id'=>$model->id));
                            echo CHtml::link('hide',$url, array('class'=>'hide-link'));
                    }else
                        throw new CHttpException('400', 'This question is already hided');
        }


	public function actionFeed()
	{
                $criteria = new CDbCriteria;
                $criteria->join = 'INNER JOIN `{{user_user_assignment}}` ON `t`.`to_id` = `{{user_user_assignment}}`.`user_2`';
                $criteria->condition = "t.status = :status AND {{user_user_assignment}}.user_1 = :user_1";
                $criteria->order = 't.updated_time ASC';
                $criteria->params = array(':status'=>self::STATUS_RESPONDED, ':user_1'=>Yii::app()->user->id);
                $criteria->with = array('receiver', 'receiver.image', 'likes', 'liked');
                $criteria->scopes = array('showed');
		$dataProvider=new CActiveDataProvider('Question', array(
                    'criteria'=>$criteria,
                    'pagination'=>array(
                        'pageSize'=>10,
                    ),
                ));
		$this->render('feed',array(
			'dataProvider'=>$dataProvider,
		));
	}
        
        public function actionLikes()
	{
                $criteria = new CDbCriteria;
                $criteria->join = 'INNER JOIN `{{user_question_assignment}}` ON `t`.`id` = `{{user_question_assignment}}`.`question_id`';
                $criteria->condition = "{{user_question_assignment}}.user_id = :user_id";
                $criteria->order = '{{user_question_assignment}}.created_time DESC';
                $criteria->params = array(':user_id'=>Yii::app()->user->id);
                $criteria->with = array('receiver', 'receiver.image', 'likes');
                $criteria->scopes = array('showed');
		$dataProvider=new CActiveDataProvider('Question', array(
                    'criteria'=>$criteria,
                    'pagination'=>array(
                        'pageSize'=>10,
                    ),
                ));
		$this->render('likes',array(
			'dataProvider'=>$dataProvider,
                        'likedcheck'=>false
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
