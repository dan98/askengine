<?php

class Gravatar extends CWidget
{
	/**
	 * @var string - Email we will use to generate the Gravatar Image  
	 */
	public $email = '';
	
	/**
	 * @var boolean - set this to true if the email is already md5 hashed
	 */
	public $hashed = false;
	
	/**
	 * @var string - Enter the default image displayed if the 
	 * Email provided to display the Gravatar does not have one.
	 * There are "special" values that you may pass to this parameter which produce dynamic default images. 
	 * These are "identicon" "monsterid" and "wavatar". 
	 * If omitted we will serve up our default image, the blue G. 
	 * A new parameter, 404, has been added to allow the return of an HTTP 404 error instead of any 
	 * image or redirect if an image cannot be found for the specified email address. 
	 * 
	 */
	public $default = '';
	
	/**
	 * @var int - Gravatar Size in px, Defaults to 40px
	 */
	public $size = 40;
	
	/**
	 * @var string - the Gravatar default rating
	 * Can be G, PG, R, X
	 *
	 * G rated gravatar is suitable for display on all websites with any audience type.
 	 *
	 * PG rated gravatars may contain rude gestures, provocatively dressed individuals, the lesser swear words, or mild violence.
	 *
	 * R rated gravatars may contain such things as harsh profanity, intense violence, nudity, or hard drug use.
	 *
	 * X rated gravatars may contain hardcore sexual imagery or extremely disturbing violence.
	 *
	 */
	public $rating = 'G';
        
        /**
	 * @var string - If isset the image will be rendered within an a tag.
	 */
        
	public $href = null;
	/**
	 * @var array - any HTML options that will be passed to the IMG tag
	 */
	public $htmlOptions = array();
	
	/**
	 * Gravatar Url
	 */
	const GRAVATAR_URL = 'http://www.gravatar.com/avatar/';
	
	/**
	 * @var string - the final constructed URL
	 */
	protected $url = '';
	
	/**
	 * @var array - url params
	 */
	protected $params = array();
	
	/**
	 * Widget Constructor
	 */
	public function init()
	{	
		// Email
		$this->url .= $this->hashed ? strtolower( $this->email ) . '?' : md5( strtolower( $this->email ) ) . '?';
		
		// Size
		$this->params['s'] = (int) $this->size;
		
		// Rating
		$this->params['r'] = $this->rating;
		
		// Default
		if( $this->default != '' )
		{
			$this->params['d'] = $this->default;
		}
		
		$array = array();
		foreach( $this->params as $key => $value )
		{
			$array[] = $key . '=' . $value;
		}
		
		$this->url .= implode('&', $array);
	}
	
	/**
	 * Run Widget and display
	 */
	public function run()
	{
                if(empty($this->href))
                    echo CHtml::image(self::GRAVATAR_URL . $this->url, $this->htmlOptions['alt'], $this->htmlOptions);
                else
                    echo CHtml::link(CHtml::image(self::GRAVATAR_URL . $this->url, $this->htmlOptions['alt'], $this->htmlOptions), $this->href);
	}
	
}