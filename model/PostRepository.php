<?php
class PostRepository
{
	private $_db; // Instance de PDO
  
	public function __construct()
	{
	$this->setDb();
	}
  
	public function setDb()
	{
		$db = new PDO('mysql:host=localhost;dbname=minimo', 'root', '');
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // On émet une alerte à chaque fois qu'une requête a échoué.
		$this->_db = $db;
	}
	
	public function getFirstArticle()
	{
		$q = $this->_db->query('SELECT * FROM posts WHERE post_type="article" AND post_status="publish" ORDER BY id');
		$donnees = $q->fetch(PDO::FETCH_ASSOC);

		return new Article($donnees);
	}
	
	public function getFile($idArticle)
	{
		
		$q = $this->_db->prepare('SELECT post_id2 FROM posts_posts WHERE post_id1=:id');
		$q->bindValue(':id', $idArticle, PDO::PARAM_INT);
		$q->execute();
		
		$post_id = $q->fetch(PDO::FETCH_ASSOC);

		$q = $this->_db->query('SELECT * FROM posts WHERE post_type="file" AND id='.$post_id["post_id2"]);
		$donnees = $q->fetch(PDO::FETCH_ASSOC);

		return new File($donnees);
	}
	
	public function getArticles()
	{
		$articles = [];

		$q = $this->_db->query('SELECT * FROM posts WHERE post_type="article" AND post_status="publish" ORDER BY id');

		while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			$articles[] = new Article($donnees);
		}

		return $articles;
	}
	
	public function getCategories()
	{
		$categories = [];

		$q = $this->_db->query('SELECT post_category FROM posts WHERE post_type="article" AND post_status="publish" GROUP BY post_category');

		while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			$categories[] = $donnees["post_category"];
		}

		return $categories;
	}
}

