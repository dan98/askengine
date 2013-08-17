<?php
class Follow extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user_user_assignment}}';
	}
        
        public function behaviors() 
        {
            return array(
                'CTimestampBehavior' => array( // Sets create_time and update_time.
                    'class' => 'zii.behaviors.CTimestampBehavior',
                    'createAttribute' => 'created_time',
                ),
            );
        }
        
        
        public function isFollowing($id)
        {
            $follow = $this->findByAttributes(array('user_1'=>Yii::app()->user->id, 'user_2'=>$id));
            return $follow;
        
        }
        
        public function createFollow($id)
        {
            if(!User::model()->findByPk($id) === null)
                throw new CHttpException(404, 'User to follow not found.');
            $model = new Follow;
            $model->user_1 = Yii::app()->user->id;
            $model->user_2 = $id;
            if($this->exists("user_1={$model->user_1} AND user_2 = {$model->user_2}")){
                return true;
            }
            if($model->save())
                return true;
            else
                return false;
        }
        public function unFollow($id)
        {
            if(!User::model()->findByPk($id) === null)
                throw new CHttpException(404, 'User to follow not found.');
            $model = $this->findByAttributes(array('user_1'=>Yii::app()->user->id, 'user_2'=>$id));
            if($model->delete())
                return true;
            else
                return false;
        }

}