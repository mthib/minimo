<?php

require('controller/frontend.php');

createHeader();

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
	displayArticles();
	displayFormNewsletter();
}

displayFooter();