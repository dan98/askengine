<?php

class RemoteUserIdentity extends CBaseUserIdentity {

	public $id;
	public $userData;
	public $email;
	public $loginProvider;
	public $loginProviderIdentifier;
	private $_adapter;
	private $_hybridAuth;

	/**
	 * @param string The provider you are using
	 * @param Hybrid_Auth An instance of Hybrid_Auth 
	 */
	public function __construct($provider,Hybrid_Auth $hybridAuth) {
		$this->loginProvider = $provider;
		$this->_hybridAuth = $hybridAuth;
	}

	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate() {
		if (strtolower($this->loginProvider) == 'openid') {
			if (!isset($_GET['openid-identity'])) {
				throw new Exception('You chose OpenID but didn\'t provide an OpenID identifier');
			} else {
				$params = array( "openid_identifier" => $_GET['openid-identity']);
			}
		} else {
			$params = array();
		}
		
		$adapter = $this->_hybridAuth->authenticate($this->loginProvider,$params);
		if ($adapter->isUserConnected()) {
			$this->_adapter = $adapter;
			$this->loginProviderIdentifier = $this->_adapter->getUserProfile()->identifier;
                        $this->userData = $this->_adapter->getUserProfile();
			$user = HaLogin::getUser($this->loginProvider, $this->loginProviderIdentifier);
			
			if ($user == null) {
				$this->errorCode = self::ERROR_USERNAME_INVALID;
			} else {
				$this->id = $user->id;
				$this->email = $user->email;
                                $this->setState('lastLogin', date("m/d/y g:i A", strtotime($user->last_login_time)));
                                $this->setState('roles', $user->role);     
                                $user->saveAttributes(array(
                                    'last_login_time'=>date("Y-m-d H:i:s", time()),
                                ));
				$this->errorCode = self::ERROR_NONE;
			}
			return $this->errorCode == self::ERROR_NONE;
		}
	}

	/**
	 * @return integer the ID of the user record
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return string the email of the user record
	 */
	public function getName() {
		return $this->email;
	}
	
	/**
	 * Returns the Adapter provided by Hybrid_Auth.  See http://hybridauth.sourceforge.net
	 * for details on how to use this
	 * @return Hybrid_Provider_Adapter adapter
	 */
	public function getAdapter() {
		return $this->_adapter;
	}
}