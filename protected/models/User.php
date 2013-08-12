<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $id
 * @property string $email safe
 * @property string $password 
 * @property string $firstname
 * @property string $lastname
 * @property string $residence
 * @property string $language
 * @property string $about
 * @property string $website
 * @property string $title
 * @property string $username safe
 * @property string $birthday 
 * @property integer $answers_n safe
 * @property integer $likes_n safe
 * @property integer $followers_n safe
 * @property string $created_time safe
 * @property string $updated_time safe
 * @property string $last_login_time safe
 * @property integer $status safe
 * @property integer $image_id safe
 * @property integer $anonym_questions
 */
class User extends CActiveRecord
{            
    const USER_MODER = 1;
    const USER_SIMPLE = 0;
    // holds the password confirmation word
    public $repeat_password;
 
    //will hold the encrypted password for update actions.
    public $initialPassword;
    
    //The attributes used to build the birthday date
    public $day;
    public $month;
    public $year;
    
        /**
	 * Here starts the callbacks.
	 */
            // Triggered before the model saves the data.
            public function beforeSave()
            {
                // If on update we dont want new password, we check this:
                if(empty($this->password) && empty($this->repeat_password) && !empty($this->initialPassword))
                $this->password=$this->repeat_password=$this->initialPassword;

                if(parent::beforeSave())
                {
                        $this->setAttribute('firstname', ucfirst($this->firstname));
                        $this->setAttribute('lastname', ucfirst($this->lastname));
                        $this->setAttribute('birthday', $this->year . '-' . $this->month . '-' . $this->day);
                        $this->setAttribute('password', $this->encrypt($this->password));
                        $this->setAttribute('status', 1);
                        $this->setAttribute('anonym_questions', 1);
                        
                }
                return true;
            }
            public function afterFind()
            {
                $explode = explode('-', $this->birthday);
                $this->year = $explode[0];
                $this->month = $explode[1];
                $this->day = $explode[2];
            }
        /**
         * Here end the callbacks.
         */  
            
        /**
	 * encrypt() Encrypts the passwords using bCrypt salt generator.
	 */
        public function encrypt($value)
        {
            $enc = NEW bCrypt();
            return $enc->hash($value);
        }
        
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return '{{user}}';
	}
        
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

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, firstname, lastname, username', 'required'),
			array('email, website', 'length', 'max'=>256),
                        array('email', 'unique'),
                        array('email', 'email'),
			array('language', 'length', 'max'=>10),
			array('username', 'length', 'max'=>16),    
                        array('title', 'length', 'max'=>16),    
                        array('password, repeat_password', 'required', 'on'=>'insert'),
                        array('password, repeat_password', 'length', 'min'=>6, 'max'=>40),
                        array('password', 'compare', 'compareAttribute'=>'repeat_password'),
                        array('role, answers_n, likes_d, followers_n, created_time, updated_time, last_login_time, status, image_id, birthday, day, month, year','safe'),
                        array('email, username','safe','on'=>'update')
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
                     'image' => array(self::HAS_ONE, 'Image', 'user_id'),
                     'questions' => array(self::HAS_MANY, 'Question', 'to_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'email' => 'Email',
			'password' => 'Password',
			'firstname' => 'Firstname',
			'lastname' => 'Lastname',
			'residence' => 'Residence',
			'language' => 'Language',
			'about' => 'About',
			'website' => 'Website',
			'title' => 'Title',
			'username' => 'Username',
			'birthday' => 'Birthday',
			'status' => 'Status',
			'image_id' => 'Image',
			'anonym_questions' => 'Anonym Questions',
		);
	}

        public function saveModel($data=array())
        {
                //because the hashes needs to match
                if(!empty($data['password']) && !empty($data['repeat_password']))
                {
                    $data['password'] = Yii::app()->user->hashPassword($data['password']);
                    $data['repeat_password'] = Yii::app()->user->hashPassword($data['repeat_password']);
                }

                $this->attributes=$data;

                if(!$this->save())
                    return CHtml::errorSummary($this);

             return true;
        }
        
        public function getAllDays()
        {
                for ($i=1;$i<=31;$i++) 
                {   
                    if($i<10)
                        $days["0{$i}"]="{$i}";
                    else
                        $days["{$i}"]="{$i}";
                }
                return $days;
        }
        public function getAllMonths()
        {
                $monthNames = array('','January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
                for ($i=1;$i<=12;$i++)
                {   
                    if($i < 10)
                        $months["0{$i}"]=Yii::t('default',$monthNames[$i]);
                    else
                        $months["{$i}"]=Yii::t('default',$monthNames[$i]);  
                }
                return $months;
        }
        public function getAllYears()
        {
                for ($i=date('Y');$i>=1970;$i--)
                {
                        $years["{$i}"]="{$i}";
                }
                return $years;                   
        }
        public function addAnswer($id){
            $user = User::model()->findByPk($id);
            $user->answers_n = $user->answers_n + 1;
            $user->password = null;
            if($user->save())
                return true;
            else{
                print_r( $user->getErrors());
            }
        }
        public function substractAnswer($id){
            $user = User::model()->findByPk($id);
            $user->answers_n = $user->answers_n - 1;
            $user->password = null;
            if($user->save())
                return true;
            else{
                print_r( $user->getErrors());
            }
        }
}