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
	
	public function getPostTypeById($idArticle)
	{
		$q = $this->_db->prepare('SELECT post_type FROM posts WHERE id = :id');
		$q->bindValue(':id', $idArticle, PDO::PARAM_INT);
		$q->execute();
		
		$donnees = $q->fetch(PDO::FETCH_ASSOC);

		return $donnees['post_type'];
	}
	
	public function getArticleById($idArticle)
	{
		$q = $this->_db->prepare('SELECT * FROM posts WHERE id = :id');
		$q->bindValue(':id', $idArticle, PDO::PARAM_INT);
		$q->execute();
		
		$donnees = $q->fetch(PDO::FETCH_ASSOC);

		return new Article($donnees);
	}
	
	public function getArticlesByCategory($category)
	{
		$articles = [];
		
		$q = $this->_db->prepare('SELECT * FROM posts WHERE post_category = :category');
		$q->bindValue(':category', $category, PDO::PARAM_STR);
		$q->execute();
		
		while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			$articles[] = new Article($donnees);
		}

		return $articles;
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

		$q = $this->_db->query('SELECT * FROM posts WHERE post_type="article" OR post_type="page" AND post_status="publish" ORDER BY id');

		while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			$articles[] = new Article($donnees);
		}

		return $articles;
	}
	
	public function getAutresArticles($idArticle)
	{
		$articles = [];

		$q = $this->_db->prepare('SELECT * FROM posts WHERE id <> :id AND post_type="article" AND post_status="publish" ORDER BY id');
		$q->bindValue(':id', $idArticle, PDO::PARAM_INT);
		$q->execute();

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
	
	public function getComments($post_id)
	{
		$comments = [];
		
		$q = $this->_db->prepare('SELECT * FROM comments WHERE post_id = :post_id');
		$q->bindValue(':post_id', $post_id, PDO::PARAM_INT);
		$q->execute();

		while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			$comments[] = new Comment($donnees);
		}

		return $comments;
	}
	
	public function getMostCommented()
	{
		/*$posts = [];
		
		$q = $this->_db->query('SELECT id,post_title FROM posts WHERE post_type="article" OR post_type="page" AND post_status="publish" ORDER BY id');

		while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			$posts[] = new array($donnees['id'],$donnees['post_title']);
		}*/
		
		$post_ids = [];
		
		$q = $this->_db->query('SELECT post_id FROM comments GROUP BY post_id');

		while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			$post_ids[] = $donnees['post_id'];
		}
		
		$comments = [];
		
		foreach($post_ids as $post_id)
		{
			
			$q = $this->_db->prepare('SELECT post_title FROM posts WHERE id = :post_id');
			$q->bindValue(':post_id', $post_id, PDO::PARAM_INT);
			$q->execute();

			while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
			{
				$comments[] = array($donnees['post_title'],$post_id);
			}
		}
		
		return $comments;
	}
}

