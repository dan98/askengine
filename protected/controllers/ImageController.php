<?php

class ImageController extends Controller
{
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
			'postOnly + delete', // we only allow deletion via POST request
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
			array('allow',
				'actions'=>array('avatar', 'identicon'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        
        
        function actionIdenticon()
        {
            Yii::import('ext.identicon.identicon');
            $identicon = new identicon;
                    $identicon->identicon_build('Querify','',true,30,$write=false,$random=false);
        }
        
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionAvatar()
	{
		$model=new Image;  // this is my model related to table
                if(isset($_POST['Image']))
                {
                    $rnd = rand(0,9999);  // generate random number between 0-9999
                    

                    $uploadedFile=CUploadedFile::getInstance($model,'image');
                    $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
                    $model->image = $fileName;
                    $model->user_id = Yii::app()->user->id;
                    $current_image = Image::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
                   
                    if($current_image)
                        $current_image->delete();
                    
                    if($model->save())
                    {
                        $uploadedFile->saveAs(dirname(Yii::app()->getBasePath())."/avatar/".$fileName);
                        Yii::import('ext.yii-easyimage.EasyImage');
                        $image = new EasyImage("avatar/".$fileName);
                        $image->crop($_POST['Image']['w'], $_POST['Image']['h'], $_POST['Image']['x1'], $_POST['Image']['y1']);
                        $image->resize(80, 80);
                        $image->save("avatar-thumb/".$fileName);
                        $this->redirect('/');
                    }
                    
                }
                $this->render('avatar',array(
                    'model'=>$model,
                ));
	}

	
	public function loadModel($id)
	{
		$model=Image::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Image $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='image-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
