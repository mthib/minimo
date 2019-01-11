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
		if(empty($user)) {
			$message = "Aucun utilisateur ne correspond à vos données";
			formLogin($message);
		}
		else {
			$_SESSION['user'] = $user;
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
	$donnees = array("post_content" => $_POST['page_content'], "post_category" => $_POST['page_category'], "post_title" => $_POST['page_title'], "id" => $_POST['page_id']);
	$page = new Article($donnees);
	
	$file = getFile($_POST['page_id']);
	$file->setPost_name($_POST['page_image']);
	
	updatePage($page);
	updateFile($file);
	
	displayHeader();
	listePages( $_POST['page_id']);
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
		if(isset($_GET["post_id"]))
			listePages($_GET["post_id"]);
		else
			listePages(0);
	}
	else 
		accueilAdmin();
}
displayFooter();