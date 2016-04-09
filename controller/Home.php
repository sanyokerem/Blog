<?php 

class Home{

	public function index(){
		$posts = ModelBlog::all_posts();
		return ['home', ['posts' => $posts]];
	}

	public function not_found(){
		return ['not_found', []];
	}
}