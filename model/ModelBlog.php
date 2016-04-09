<?php 


class ModelBlog{

	public function all_posts(){
		$p = \App::$db->prepare(" SELECT * FROM posts ORDER BY id DESC");
		$p->execute();
		return $p->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function user_posts($user_name = ''){
		$p = \App::$db->prepare(" SELECT * FROM posts WHERE user_name = ? ");
		$p->execute([\App::$user->get_name()]);
		return $p->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function add_post(){
		$date = new \DateTime();
		$date = $date->format('Y-m-d H:i:sP');
		// $date = $date  
		$p = App::$db->prepare(" INSERT INTO posts(title, content, user_name, date) VALUES(?, ?, ?, ?) ");
		$p->execute([$_POST['title'], $_POST['content'], \App::$user->get_name(), $date]);
	}

	public function remove_post(){
		$p = App::$db->prepare(" DELETE FROM posts WHERE id = ? ");
		$p->execute([$_GET['id']]);
	}


}