<?php 
session_start();
// Chargement des classes/*
require_once('PostRepository.php');
require_once('Article.php');
require_once('File.php');

$postRepository = new PostRepository();

$start = $_SESSION["startArticle"];

$articles = $postRepository->getArticles($start,2);

$articlesFiles = array();
foreach($articles as $article) {
	$fileArticle = $postRepository->getFile($article->id());
	$articlesFiles[] = array($article,$fileArticle);
}


require '../view/articlesView.php';