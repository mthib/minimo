<?php
require_once('PostRepository.php');
require_once('Comment.php');

$postRepository = new PostRepository();
$donnees = array("post_id" => $_POST['post_id'],
				"comment_name" => $_POST['comment_name'],
				"comment_email" => $_POST['comment_email'],
				"comment_content" => $_POST['comment_content'],
				"comment_date" => getdate());

$comment = new Comment($donnees);

$retourInsert = $postRepository->insertComment($comment);

echo json_encode(['reponse' => $retourInsert]);

