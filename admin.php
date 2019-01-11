<?php
session_start();
require('controller/backend.php');

if(isset($_GET['deconnexion']))
{
	$_SESSION = array();
}
// Si on a voulu s'identifier
if (isset($_POST['login_submit'])) 
{
	if(empty($_POST['username']) || empty($_POST['password'])){
		$message = "Veuillez renseigner tous les champs";
		formLogin($message);
	}
	else{
		$user = verifLogin($_POST['username'],$_POST['password']);
		if(empty($user->user_login())) {
			$message = "Aucun utilisateur ne correspond à vos données";
			formLogin($message);
		}
		else {
			$_SESSION['user'] = $user->user_login();
			$_SESSION['userId'] = $user->id();
			header('Location: admin.php');
			
		}
	}
}
	
// Si on a voulu créer un utilisatuer.
elseif (isset($_POST['signup_submit'])) 
{
	if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['password2'])){
		$message = "Veuillez renseigner tous les champs";
		formSignUp($message);
	}
	else {
		// libre = nb d'user avec ce login donc 0 ou 1 normalement
		$libre = verifPseudoLibre($_POST['username']);
		
		if($libre > 0) {
			$message = "Ce pseudo n'est pas disponible";
			formSignUp($message);
		}
		elseif($_POST['password'] != $_POST['password2']) {	
			$message = "Les mots de passe ne correspondent pas";
			formSignUp($message);	
		}
		else{
			insertUser($_POST['username'],$_POST['password']);
			$_SESSION['user'] = $_POST['username'];
			header('Location: admin.php');
		}	
	}
	
}
// Si on a voulu enregistrer une page
elseif (isset($_POST['page_submit'])) 
{
	//gere valeur publish 
	if(isset($_POST['page_publish']) && $_POST['page_publish'] == "on")
		$publish = "publish";
	else
		$publish = "unpublish";
	
	$donnees = array("post_content" => $_POST['page_content'],
					"post_type" => $_POST['page_type'],
					"post_category" => $_POST['page_category'],
					"post_title" => $_POST['page_title'], 
					"id" => $_POST['page_id'], 
					"post_status" => $publish,
					"post_name" => $_POST['page_image']);
	$page = new Article($donnees);
	
	
	
	//si pas d'id c'est une nouvelle page
	if(empty($_POST['page_id'])) {
		$idAAfficher = addPage($page,$_POST['page_type']);
		addFile($page, $idAAfficher);
		
	}
	else
	{
		$idAAfficher = $_POST['page_id'];
		updatePage($page);
		
		$file = getFile($_POST['page_id']);
		$file->setPost_name($_POST['page_image']);

		updateFile($file);
	}
	
	
	displayHeader();
	listePages($_POST['page_type'], $idAAfficher);
}
elseif (isset($_POST['page_delete'])) 
{
	deletePage($_POST['page_id']);
	
	displayHeader();
	accueilAdmin();
}
elseif (isset($_GET["creerCompte"])){
	formSignUp("");
}
elseif (!isset($_SESSION['user'])) {
	formLogin("");
}
else {
	displayHeader();
	if(isset($_GET["section"]) && $_GET["section"] == "pages")
	{
		if(isset($_GET["newPage"]) && $_GET["newPage"] == "true") {
			listePages("page", null);
		}
		elseif(isset($_GET["post_id"]))
			listePages("page", $_GET["post_id"]);
		else
			listePages("page", -1);
	}
	elseif(isset($_GET["section"]) && $_GET["section"] == "articles")
	{
		if(isset($_GET["newPage"]) && $_GET["newPage"] == "true") {
			listePages("article", null);
		}
		elseif(isset($_GET["post_id"]))
			listePages("article", $_GET["post_id"]);
		else
			listePages("article", -1);
	}
	else	accueilAdmin();
}
displayFooter();