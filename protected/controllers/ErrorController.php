<?php

class ErrorController extends Controller
{
	/**
	 * Controller that handels errors.
	 */
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionIndex()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}
}