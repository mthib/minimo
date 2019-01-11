<?php

// Chargement des classes
require_once('model/Article.php');
require_once('model/File.php');
require_once('model/Comment.php');
require_once('model/AdminRepository.php');

function formSignUp($message)
{

    require('view/signUpView.php');
}

function formLogin($message)
{
    require('view/loginView.php');
}

function listePages($post_id)
{
	$repository = new AdminRepository();
	
	if($post_id == 0) 
		$post_id = $repository->getFirstPageId();
	
	$page = $repository->getPageById($post_id);
	$fileArticle = $repository->getFile($post_id);
	$titles = $repository->getTitlePages();
	$categories = $repository->getCategories();	
	$images = $repository->getImages();	
	
    require('view/pagesAdmin.php');
}

function getFile($id)
{
	$repository = new AdminRepository();
	return $repository->getFile($id);
}

function updatePage($page)
{
	$repository = new AdminRepository();
	$repository->updatePage($page);
}

function updateFile($file)
{
	$repository = new AdminRepository();
	$repository->updateFile($file);
}

function insertUser($login,$pwd)
{
	$repository = new AdminRepository();
	$repository->insertUser($login,$pwd);
}

function verifLogin($login,$pwd)
{
	$repository = new AdminRepository();
	return $repository->verifLogin($login,$pwd);
}

function verifPseudoLibre($login)
{
	$repository = new AdminRepository();
	return $repository->verifPseudoLibre($login);
}

function displayHeader()
{
	require('view/headerAdmin.php');
}

function displayFooter()
{
	require('view/footerAdmin.php');
}

function accueilAdmin()
{
	require('view/accueilAdmin.php');
}
