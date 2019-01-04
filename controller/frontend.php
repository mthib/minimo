<?php

// Chargement des classes
require_once('model/Article.php');
require_once('model/File.php');
require_once('model/PostRepository.php');

function firstArticle()
{
	$postRepository = new PostRepository();
	$firstArticle = $postRepository->getFirstArticle();
	$fileFirstArticle = $postRepository->getFile($firstArticle->id());
    require('view/firstArticleView.php');
}

function displayArticles()
{
	$postRepository = new PostRepository();
	$articles = $postRepository->getArticles();
	
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

function createHeader()
{
	$postRepository = new PostRepository();
	$categories = $postRepository->getCategories();
	
	require('view/header.php');
}

