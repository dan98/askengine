<?php
class FollowController extends Controller
{
    
    	public function actionIsfollowing($id)
	{
            return Follow::model()->isFollowing($id);
	}
        
        
	public function actionCreateFollow($id)
	{
            if(Follow::model()->createFollow($id)){
                $url = Yii::app()->createAbsoluteUrl('follow/unFollow/', array('ajax'=>1, 'id'=>$id));
                
                $this->widget('bootstrap.widgets.TbButton', array(
                    'label'=>'unfollow',
                    'type'=>'warning',
                    'size'=>'small',
                    'htmlOptions'=>array(
                        'href'=>$url,
                        'class'=>'unfollow-link'
                    ),
                    'buttonType'=>'button'
                ));
            }
	}

	public function actionUnFollow($id)
	{
            if(Follow::model()->unFollow($id)){
                $url = Yii::app()->createAbsoluteUrl('follow/createFollow/', array('ajax'=>1, 'id'=>$id));
                
                $this->widget('bootstrap.widgets.TbButton', array(
                    'label'=>'follow',
                    'type'=>'success',
                    'size'=>'small',
                    'htmlOptions'=>array(
                        'href'=>$url,
                        'class'=>'follow-link'
                    ),
                    'buttonType'=>'button'
                ));
            }
	}

	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'postOnly + follow, isFollowing, unFollow'
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