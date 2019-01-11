<?php

// Chargement des classes
require_once('model/Article.php');
require_once('model/File.php');
require_once('model/Comment.php');
require_once('model/PostRepository.php');

function countArticles()
{
	$postRepository = new PostRepository();
	$postRepository->countArticles();
}

function firstArticle()
{
	$postRepository = new PostRepository();
	$article = $postRepository->getFirstArticle();
	$fileArticle = $postRepository->getFile($article->id());
    require('view/firstArticleView.php');
}

function displayPage($id)
{
	$postRepository = new PostRepository();
	$article = $postRepository->getArticleById($id);
	$fileArticle = $postRepository->getFile($article->id());
    require('view/firstArticleView.php');
}

function displayArticle($id)
{
	$postRepository = new PostRepository();
	$article = $postRepository->getArticleById($id);
	$fileArticle = $postRepository->getFile($article->id());
    require('view/firstArticleView.php');
}

function displayArticleWithSideBar($id)
{
	$postRepository = new PostRepository();
	
	$article = $postRepository->getArticleById($id);
	$fileArticle = $postRepository->getFile($article->id());
	
	$comments = $postRepository->getMostCommented();

    require('view/articleSideBarView.php');
}


function displayArticles($start,$nbArticleAfficher)
{
	$postRepository = new PostRepository();
	$articles = $postRepository->getArticles($start,$nbArticleAfficher);
	
	$articlesFiles = array();
	foreach($articles as $article) {
		$fileArticle = $postRepository->getFile($article->id());
		$articlesFiles[] = array($article,$fileArticle);
	}

    require('view/divArticlesView.php');
}

function displayCategory($category)
{

	$postRepository = new PostRepository();
	$articles = $postRepository->getArticlesByCategory($category);
	
	$articlesFiles = array();
	foreach($articles as $article) {
		$fileArticle = $postRepository->getFile($article->id());
		$articlesFiles[] = array($article,$fileArticle);
	}

    require('view/articlesView.php');
}

function displayFormNewsletter()
{
	require('view/formNewsletterView.php');
}

function displayBarShare()
{
	require('view/barShareView.php');
}

function createHeader()
{
	$postRepository = new PostRepository();
	$categories = $postRepository->getCategories();
	
	require('view/header.php');
}

function autresArticles($post_id)
{
	$postRepository = new PostRepository();
	$articles = $postRepository->getAutresArticles($post_id);
	
	$articlesFiles = array();
	foreach($articles as $article) {
		$fileArticle = $postRepository->getFile($article->id());
		$articlesFiles[] = array($article,$fileArticle);
	}

    require('view/autresArticlesView.php');
}

function displayComments($post_id)
{
	$postRepository = new PostRepository();
	$comments = $postRepository->getComments($post_id);

    require('view/commentsView.php');
}

function displayFooter()
{
	require('view/footer.php');
}

function getPostType($id)
{
	$postRepository = new PostRepository();
	$type = $postRepository->getPostTypeById($id);
	return $type;
}

