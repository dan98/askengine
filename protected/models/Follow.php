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
		return '{{user_user_assigment}}';
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'follower'=>array(self::HAS_ONE, 'User', 'user_1'),
                    'follows'=>array(self::HAS_ONE, 'User', 'user_2')
		);
	}
        
        public function isfollowing($id)
        {
            $follow = $this->findByAttributes(array('user_1'=>Yii::app()->user->id, 'user_2'=>$id));
            return true;
        }
        
        public function follow($id)
        {
            if(!User::model()->findByPk($id) === null)
                throw new CHttpException(404, 'User to follow not found.');
            $this->user_1 = Yii::app()->user->id;
            $this->user_2 = $id;
            if($this->save())
                return true;
            else
                return false;
        }
        public function unFollow($id)
        {
            if(!User::model()->findByPk($id) === null)
                throw new CHttpException(404, 'User to follow not found.');
            $this->user_1 = Yii::app()->user->id;
            $this->user_2 = $id;
            if($this->delete())
                return true;
            else
                return false;
        }

}