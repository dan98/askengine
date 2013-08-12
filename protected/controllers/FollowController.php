<?php
class FollowController extends Controller
{
    
    	public function actionIsfollowing($id)
	{
         if(Follow::model()->isfollowing($id)){
             echo true;
         }
	}
        
        
	public function actionFollow($id)
	{
	 Follow::model()->follow($id);
	}

	public function actionUnFollow($id)
	{
	 Follow::model()->unFollow($id);
	}

	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			//'postOnly + follow, isFollowing, unFollow'
		);
	}
}