<?php 

class ModelUser{

	protected $name;
	protected $pass;
	public static $db;

	public function __construct($name, $pass){
		$this->name = $name;
		$this->pass = $pass;
	}

	public function save(){

		$p = self::$db->prepare("INSERT INTO users(name, pass) VALUES (?, ?) ");
		$p->execute([$this->name, password_hash($this->pass, PASSWORD_DEFAULT)]);
		
	}

	public function finde_user(){

		$p = self::$db->prepare("SELECT * FROM users WHERE name = ? LIMIT 1 ");
		$p->execute([$this->name]);
		$db_user = $p->fetch(PDO::FETCH_ASSOC);
		return password_verify($this->pass, $db_user['pass']);
		
		//Router::redirect('user/login');
	}

	public function get_name(){
		return $this->name;
	}
}

ModelUser::$db = App::$db;