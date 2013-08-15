<?php

/**
 * This is the model class for table "{{user_question_assignment}}".
 *
 * The followings are the available columns in table '{{user_question_assignment}}':
 * @property integer $user_id
 * @property integer $question_id
 */
class Like extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Like the static model class
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
		return '{{user_question_assignment}}';
	}

	/**
	 * @return array relational rules.
	 */
	public function likes($id)
        {
            $like = $this->findByAttributes(array('user_id'=>Yii::app()->user->id, 'question_id'=>$id));
            return $like;
        
        }
        
        public function createLike($id)
        {
            if(!Question::model()->findByPk($id) === null)
                throw new CHttpException(404, 'Question to like not found.');
            $model = new Like;
            $model->user_id = Yii::app()->user->id;
            $model->question_id = $id;
            if($this->exists("user_id={$model->user_id} AND question_id = {$model->question_id}")){
                return true;
            }
            if($model->save())
                return true;
            else
                return false;
        }
        public function dislike($id)
        {
            if(!Question::model()->findByPk($id) === null)
                throw new CHttpException(404, 'Question to dislike not found.');
            $model = $this->findByAttributes(array('user_id'=>Yii::app()->user->id, 'question_id'=>$id));
            if($model->delete())
                return true;
            else
                return false;
        }
}