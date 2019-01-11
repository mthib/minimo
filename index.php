<?php
session_start();
require('controller/frontend.php');

createHeader();
countArticles();
$_SESSION["startArticle"] = 0;

if(isset($_GET['category']))
{
	displayCategory($_GET['category']);
	displayFormNewsletter();
}
elseif(isset($_GET['post_id']))
{
	$post_type = getPostType($_GET['post_id']);
	
	if($post_type == "page") {
		displayPage($_GET['post_id']);	
		displayBarShare();
	}
	elseif($post_type == "article")
	{
		displayArticleWithSideBar($_GET['post_id']);
	}
	
	
	autresArticles($_GET['post_id']);
	displayComments($_GET['post_id']);
}
else
{
	
	firstArticle();
	// affiche les articles a partir de 0 jusqu'a 4
	displayArticles(0,4);
	
	displayFormNewsletter();
}

displayFooter();