<?php

class LikeController extends Controller
{
	public function actionLikes($id)
	{
            return Like::model()->likes($id);
	}
        
        
	public function actionCreateLike($id)
	{
            if(Like::model()->createLike($id)){
                $url = Yii::app()->createAbsoluteUrl('like/dislike/', array('ajax'=>1, 'id'=>$id));
                echo CHtml::link('dislike',$url, array('class'=>'dislike-link')); 
            }
	}

	public function actionDislike($id)
	{
            if(Like::model()->dislike($id)){
                $url = Yii::app()->createAbsoluteUrl('like/createLike/', array('ajax'=>1, 'id'=>$id));
                echo CHtml::link('like',$url, array('class'=>'like-link'));
            }
	}
        
        public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'postOnly + likes, like, dislike'
		);
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
		$model=Follow::model()->findByPk($id);
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