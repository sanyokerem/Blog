<?php 

class User{

	protected function convert_to_user(){

		if($_SERVER['REQUEST_METHOD'] == 'POST'){

			$user = new ModelUser($_POST['name'], $_POST['pass']);
			return $user;

		}

	}
 
	public function register(){

		$user = $this->convert_to_user();

		if($user){
			$user->save();
			Router::redirect('/user/login');
		}
		return ['user/user_form_page', [
			'form_title'=>'Register user',
			'submite_text'=>'Register']];
		Router::redirect('/user/login');
	}

	public function login(){

		$user = $this->convert_to_user();
		if($user){
			if($user->finde_user()){
				$_SESSION['user']  = $user;
				Router::redirect();
			}
		}

		return ['user/user_form_page', [
			'form_title'=>'Login user',
			'submite_text'=>'Login']];
	}

	public function logout(){
		$_SESSION['user'] = NULL;
		Router::redirect();
	}
}