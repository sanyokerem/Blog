<?php 


class Blog{

	public function index(){
		$posts = ModelBlog::user_posts(\App::$user->get_name());
		return ['blog/posts', ['posts' => $posts]];	
	}

	public function add(){
		$post = ModelBlog::add_post();
		Router::redirect('/blog');
	}

	public function remove(){
		$post = ModelBlog::remove_post();
		Router::redirect('/blog');
	}
}