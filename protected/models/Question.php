<?php

/**
 * This is the model class for table "{{question}}".
 *
 * The followings are the available columns in table '{{question}}':
 * @property integer $id
 * @property string $question_text
 * @property integer $question_video_id
 * @property integer $from_id
 * @property integer $to_id
 * @property string $answer_text
 * @property integer $answer_video_id
 * @property integer $likes_n
 * @property integer $anonym
 * @property integer $status
 * @property string $created_time
 */
class Question extends CActiveRecord
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
         * Retrieves a list of issue types
         * @return array an array of available issue types.
         */
        public function getAnonymOptions()
        {
            return array(
                self::ANONYM_FALSE=>'Show me',
                self::ANONYM_TRUE=>'Anonym',
                self::ANONYM_CUSTOM=>'Custom',
            );
        }
        
        public function getAnonymRange()
        {
            return array(
                self::ANONYM_FALSE,
                self::ANONYM_TRUE,
                self::ANONYM_CUSTOM,
            );
        }
        
        /**
	 * Here starts the callbacks.
	 */
            
        /**
         * Here end the callbacks.
         */  
            
        /**
	 * @return array of behaviors.
	 */
        public function behaviors() 
        {
            return array(
                'CTimestampBehavior' => array( // Sets create_time and update_time.
                    'class' => 'zii.behaviors.CTimestampBehavior',
                    'createAttribute' => 'created_time',
                    'updateAttribute' => 'updated_time',
                    'setUpdateOnCreate' => true,
                ),
            );
        }
        
        public function scopes()
        {
            return array(
                'new'=>array(
                    'condition'=>'status='.self::STATUS_NEW,
                ),
                'responded'=>array(
                    'condition'=>'status='.self::STATUS_RESPONDED,
                ),
                'ignored'=>array(
                    'condition'=>'status='.self::STATUS_IGNORED,
                ),
                'mine'=>array(
                    'condition'=>'to_id='.Yii::app()->user->id
                ),
                'hided'=>array(
                    'condition'=>'hide='.self::HIDE_TRUE
                ),
                'showed'=>array(
                    'condition'=>'hide='.self::HIDE_FALSE
                )
            );
        }
        
        public function of($id)
        {
            $this->getDbCriteria()->mergeWith(array(
                'condition'=>'to_id=:id',
                'params'=>array(':id'=>$id),
            ));
            return $this;
        }
        
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Question the static model class
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
		return '{{question}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('question_text, to_id, anonym', 'required', 'on'=>'create'),
                        array('answer_text', 'required', 'on'=>'update'),
			array('question_video_id, from_id, answer_text, answer_video_id, likes_n, status, updated_time, created_time', 'safe', 'on'=>'create'),
                        array('question_video_id, from_id, question_text, to_id, answer_video_id, likes_n, status, anonym, updated_time, created_time, anonym_custom', 'safe', 'on'=>'update'),
                        array('to_id, hide', 'numerical', 'integerOnly'=>true),
                        array('anonym', 'in', 'range'=>$this->getAnonymRange()),
                        array('anonym_custom', 'length', 'min'=>5, 'max'=>30, 'tooShort'=>'At least 5 characters','tooLong'=>'Max 30')
                    );
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'sender'=>array(self::BELONGS_TO, 'User', 'from_id',
                                'with'=>array(
                                    'image'
                                ),
                    ),
                    'receiver'=>array(self::BELONGS_TO, 'User', 'to_id',
                                'with'=>array(
                                    'image'
                                ),
                    ),
                    'likes'=>array(self::STAT, 'User', '{{user_question_assignment}}(question_id, user_id)'),
                    'liked'=>array(self::STAT, 'User', '{{user_question_assignment}}(question_id, user_id)', 'condition'=>"user_id=".Yii::app()->user->id)
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'question_text' => 'Question Text',
			'question_video_id' => 'Question Video',
			'from_id' => 'From',
			'to_id' => 'To',
			'answer_text' => 'Answer Text',
			'answer_video_id' => 'Answer Video',
			'likes_n' => 'Likes N',
			'anonym' => 'Anonym',
			'status' => 'Status',
			'created_time' => 'Created Time',
		);
	}

}