<?php

Class HomeController extends BaseController {

	public function home(){
		$articles = Articles::All();
		//return $articles;
		return View::make('home')
				->with('articles', $articles);
	}

}

