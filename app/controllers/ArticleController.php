<?php

class ArticleController extends BaseController{
	public function articlePost($articleId){

		$article = Articles::findOrFail($articleId);

		return View::make('articles.articlePost')->with('article', $article);
	}
}