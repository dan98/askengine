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
        
        const SEEN = 1;
        const NOT_SEEN = 0;
                
	public $layout='//layouts/page';
        public $defaultAction='feed';

	/**
        * Returns.
        */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + respond, ignore, delete, hide, show', // we only allow deletion via POST request
                        'iAmTheReceiver + respond, ignore, delete, hide, show'
		);
	}
        
	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('view'),
				'users'=>array('*'),
			),
			array('allow',
				'actions'=>array('feed','ignored','answers','hided','likes', 'new', 'respond', 'delete', 'ignore', 'hide', 'show'),
				'users'=>array('@'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}
        
        
        /**
        * GET Pages. View, Feed, New, Ignored, Answers, Hided, Likes
        */
        
        
        public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
        
	public function actionFeed()
	{
                $criteria = new CDbCriteria;
                $criteria->join = 'INNER JOIN `{{user_user_assignment}}` ON `t`.`to_id` = `{{user_user_assignment}}`.`user_2`';
                $criteria->condition = "{{user_user_assignment}}.user_1 = :user_1";
                $criteria->order = 't.updated_time DESC';
                $criteria->params = array(':user_1'=>Yii::app()->user->id);
                $criteria->with = array('receiver', 'receiver.image', 'likes', 'liked', 'sender');
                $criteria->scopes = array('showed', 'responded');
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
        
        public function actionNew()
        {
            // Question ActiveRecord
            $q=new Question('self');

            if(isset($_POST['Question']))
            {
                    if(Yii::app()->user->isGuest)
                        $this->redirect(array('user/login'));
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
            
            $dataProvider=new EActiveDataProvider('Question', array(
                'scopes'=>array('new', 'mine'),
                'criteria'=>array(
                    'order' => 't.created_time DESC',
                    'with' => array('liked', 'likes', 'sender')
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
            $dataProvider=new EActiveDataProvider('Question', array(
                'scopes'=>array('ignored', 'mine'),
                'criteria'=>array(
                    'order' => 't.created_time DESC',
                    'with' => array('liked', 'likes', 'sender', 'receiver.image', 'receiver')
                ),
                'pagination'=>array(
                    'pageSize'=>10,
                ),
            ));

            $this->render('ignored',array(
                'dataProvider'=>$dataProvider
            ));
        }
        
        public function actionAnswers()
        {
            $dataProvider=new EActiveDataProvider('Question', array(
                'scopes'=>array('responded', 'notseen', 'fromme'),
                'criteria'=>array(
                    'order' => 't.created_time DESC',
                    'with' => array('liked', 'likes', 'sender', 'receiver.image', 'receiver')
                ),
                'pagination'=>array(
                    'pageSize'=>10,
                ),
            ));
            $this->render('answers',array(
                'dataProvider'=>$dataProvider,
                'user'=>User::model()->findByPk(Yii::app()->user->id)
            ));
            Question::model()->updateAll(array('seen'=>self::SEEN), 'from_id = '.Yii::app()->user->id);
            
        }
        
        public function actionHided()
        {
            $dataProvider=new EActiveDataProvider('Question', array(
                'scopes'=>array('hided', 'responded', 'mine'),
                'criteria'=>array(
                    'order' => 't.created_time DESC',
                    'with' => array('liked', 'likes', 'sender', 'receiver.image', 'receiver')
                ),
                'pagination'=>array(
                    'pageSize'=>10,
                ),
            ));

            $this->render('hided',array(
                'dataProvider'=>$dataProvider
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
         * 
         * 
         * POST Actions. Respond, Delete, Ignore, Show, Hide
         * 
         * 
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
                        throw new CHttpException('400', 'Această întrebare este deja ascunsă.');
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
        
        
	/**
	 * Underground
	 */
	public function loadModel($id)
	{
		$model=Question::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
        
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='question-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
