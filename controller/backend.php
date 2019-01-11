<?php

// Chargement des classes
require_once('model/Article.php');
require_once('model/File.php');
require_once('model/User.php');
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

function listePages($type, $post_id)
{
	$repository = new AdminRepository();
	
	// si on cree une nouvelle page
	if($post_id == null) {
		$titles = $repository->getTitlePages($type);
		$categories = $repository->getCategories();	
		$images = $repository->getAllImages();	
		$page = new Article([]);
		$fileArticle = new File([]);
	}
	else {
		// -1 designe qu'on arrive sur la page et qu'on doit afficher la premiere page enregistree
		if($post_id == -1) 
			$post_id = $repository->getFirstPageId($type);
	
		$page = $repository->getPageById($post_id);
		$fileArticle = $repository->getFile($post_id);
		$titles = $repository->getTitlePages($type);
		$categories = $repository->getCategories();	
		$images = $repository->getAllImages();	
	}
	
	
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

function addPage($page, $type)
{
	$repository = new AdminRepository();
	// renvoie l'id de l'enregistrement
	return $repository->addPage($page, $type);
}
	

function deletePage($post_id)
{
	$repository = new AdminRepository();
	// renvoie l'id de l'enregistrement du fichier
	$file_id = $repository->getFileId($post_id);
	
	$repository->deletePostsPosts($post_id);
	
	// supprime le fichier puis la page/article
	$repository->deletePost($file_id);
	$repository->deletePost($post_id);
}



function updateFile($file)
{
	$repository = new AdminRepository();
	$repository->updateFile($file);
}

function addFile($page, $page_id)
{
	$repository = new AdminRepository();
	// renvoie l'id de l'enregistrement
	$file_id = $repository->addFile($page);
	$repository->addPosts_posts($page_id, $file_id);
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
