<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/***********************
Users model
************************/

class Users_model extends MY_Model{
	
    public $table = 'users';
    public $pk = 'id';
    
    public function getRecords($page = null, $per_page = null, $where)
    {
        if(!empty($where)){
            $this->db->where($where);
        }
        if(!is_null($page) && !is_null($per_page)){
            $this->db->limit($page, $per_page);    
        }
        return parent::getRecords();
    }
    
    public function getHotelliers()
    {
        return parent::getRecords(array('user_type' => 2));
    }
    
    /**
    * Hashes a user password. requires phpass
    * 
    * @param mixed $password
    */
	private function hashPassword($password){
		$this->load->library('phpass');
		$this->phpass->setup(8, false);
		
		$hash = $this->phpass->HashPassword($password);
		if ($hash == "*")
			throw new Exception("Error Hashing Password", 1);
		return $hash;
	}

    /***
    * Gets users by a specific field. Helper function not by harry)
    * 
    * @param mixed $field_array
    */
	private function _getUserByField($field_array){
		$ret = $this->db->from('users')->where($field_array)->get();
		if ($ret->num_rows()==0)
			return null;
		return $ret->first_row();	
	}

	/***
	Registers a new user
	Returns userRegistrationObject
	***/
	public function registerUser($email,$firstName,$lastName,$password,$pre_authorized=false){

		
		if ($pre_authorized)
			$auth_code = md5(rand(1000,9999));
		else
			$auth_code ="";
		
		$this->db->insert('users',array(
			'email'=>$email,
			'first_name'=>$firstName,
			'last_name'=>$lastName,
			'has_store'=>0,
			'password'=>$this->hashPassword($password),
			'last_login'=>'0000-00-00',
			'create_date'=>date('Y-m-d'),
			'auth_code'=>$auth_code,
			'oauth_code'=>''			
			));
		return array("userId"=>$this->db->insert_id,"code"=>$auth_code);		
	}

	/*** 
	User Registeration New Function --Tony Arora*/
	public function registerUserNew($email,$firstName,$lastName,$password, $vars = array()){

        $arr = array(
            'email'=>$email,
            'first_name'=>$firstName,
            'last_name'=>$lastName,
            'password'=>$this->hashPassword($password),
            'create_date'=>date('Y-m-d')
        );
        
        $data = $arr + $vars;
        
		$this->db->insert('users',$data);
		$lastInsertId = $this->db->insert_id();
		return array("userId"=>$lastInsertId);
	}
    
    public function updateUser($id, $email, $password, $firstName,$lastName, $vars = array())
    {
        $arr = array(
            'email'=>$email,
            'first_name'=>$firstName,
            'last_name'=>$lastName,
        );
        if(!empty($password)){
            $arr['password'] = $this->hashPassword($password);
        }
        
        $data = $arr + $vars;
        
        $this->db->where('id',$id)->update('users',$data);
    }
	
	/***
	Changes a user password
		if oldpassword is provided, then it is validated
	**/
	public function changePassword($id_user,$newPassword,$oldPassword=null){
		if (!is_null($oldPassword))
			//$user = $this->_getUserByField(array('id'=>$id_user,'password'=>$this->hashPassword($oldPassword)));		
			//REPLACE THIS WITH HASH CHECK
			die("PLEASE FIX ME!");
		else
			$user = $this->_getUserByField(array('id'=>$id_user));

		if (is_null($user))
			return null;
		else 
			$this->db->where('id',$user->id)->update('users',array('password'=>$this->hashPassword($newPassword)));
		return TRUE;
	}

	
	/***
	Resets the user authorization code
	Returns the new authorization code
	****/
	public function resetAuthCode($userId,$remove_auth_code=false){
		if (!$remove_auth_code)
			$auth_code = md5(rand(1000,9999));
		else
			$auth_code = "";
		$this->db->where('id',$userId)->update('users',array('auth_code'=>$auth_code));
		return $auth_code;
	}

	/***
	Gets a user by email
	Returns user object, NULL of not found
	***/
	public function getUserByEmail($email){
		return $this->_getUserByField(array('email'=>$email));
                
                
	}

	/***
	Gets a user by email and password
	Returns user object, NULL of not found
	**/
	public function getUserByEmailPassword($email,$password){
		$usr =  $this->_getUserByField(array('email'=>$email,'user_type !='=>'3'));	
		if (!is_null($usr)){
			$this->load->library('phpass');
			$this->phpass->setup(8, false);
			if ($this->phpass->CheckPassword($password,$usr->password))
				return $usr;
			else
				return null;
		}
	}

	/***
	Gets user by id
	Returns user object, NULL of not found
	**/
	public function getUserById($id){
		return $this->_getUserByField(array('id'=>$id));
	}

	/***
	Gets a user by his remember key
	Returns user object, NULL of not found
	***/
	public function getUserByRememberKey($rememberKey){
		return $this->_getUserByField(array('remember_key'=>$remember_key));
	}

	/***
	Updates last login date
	Returns null
	***/
	public function updateLastLogin($userId){
		$this->db->where('id',$userId)->update('users',array('last_login'=>date('Y-m-d')));
	}

	/***
	Sets a new remember key
	Returns null
	*/
	public function setRememberKey($userId,$key){
		$this->db->where('id',$userId)->update('users',array('remember_key'=>$key));
	}


	/***
	Updates reset password information
	Returns a new reset key
	*/
	public function updateResetPass($email){
		//Generate key
		$is_unique=FALSE;
		while($is_unique==FALSE){
			$key = base64_encode(md5(rand(1000,9999) . time()));
			$ret = $this->db->from('users')->where('reset_key',$key)->select('id')->get();
			if ($ret->num_rows()==0)
				$is_unique = TRUE;
		}
		$this->db->where('email',$email)->update('users',array('reset_key'=>$key,'reset_date'=>date('Y-m-d')));
		return $key;
	}

	/***
	Reset code exists
	Returns boolean
	***/
	public function resetCodeExists($resetKey){
		$ret = $this->db->from('users')->where('reset_key',$resetKey)->select('id')->get();
		if ($ret->num_rows()==0)
			return FALSE;
		return TRUE;
	}

	/***
	Update a new password based on reset
	Returns True if operation is complete, null if  key is invalid, false if operation timed out
	**/
	public function updatePassFromReset($resetKey,$newPass){
		$ret= $this->db->from('users')->where('reset_key',$resetKey)->select('id')->select('DATEDIFF(NOW(),reset_date) AS diff',false)->get();

		if ($ret->num_rows()==0){
			return NULL;	//Key is invalid
		}else{
			$user_nfo = $ret->first_row();

			if ($user_nfo->diff > 2)
				return FALSE; // Key expired

			$id = $user_nfo->id;
			if ($this->changePassword($id,$newPass)){
				//If the password is successfully changed, then delete the reset key
				$this->db->where('id',$id)->update('users',array('reset_key'=>""));
			}
		}
	}

}

