<?php
require_once('PostRepository.php');

$postRepository = new PostRepository();

$retourInsert = $postRepository->insertNewsletter($_POST["emailNewsletter"]);

echo json_encode(['reponse' => $retourInsert]);

