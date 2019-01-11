<?php
class AdminRepository
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
	
	public function insertUser($userName,$pwd)
	{
		
		$q = $this->_db->prepare("INSERT INTO users (id, user_login, user_pass) VALUES (NULL, :user_name, :pwd)");
		$q->bindValue(':user_name', $userName, PDO::PARAM_STR);
		$q->bindValue(':pwd', $pwd, PDO::PARAM_STR);

		return $q->execute();
	}
	
	
	public function verifLogin($userName,$pwd)
	{
		
		$q = $this->_db->prepare("SELECT * FROM users WHERE user_login = :user_name AND user_pass = :pwd");
		$q->bindValue(':user_name', $userName, PDO::PARAM_STR);
		$q->bindValue(':pwd', $pwd, PDO::PARAM_STR);
		$q->execute();
		
		$user = $q->fetch(PDO::FETCH_ASSOC);
		
		return $user['user_login'];
	}	
	
	public function verifPseudoLibre($userName)
	{
		
		$q = $this->_db->prepare("SELECT COUNT(*) as userExist FROM users WHERE user_login = :user_name");
		$q->bindValue(':user_name', $userName, PDO::PARAM_STR);
		$q->execute();
		
		$user = $q->fetch(PDO::FETCH_ASSOC);
		
		return $user['userExist'];
	}
	
	public function getCategories()
	{
		$categories = [];

		$q = $this->_db->query('SELECT post_category FROM posts WHERE post_type="article" OR post_type="page" GROUP BY post_category');

		while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			$categories[] = $donnees["post_category"];
		}

		return $categories;
	}
	
	public function getImages()
	{
		$images = [];

		$q = $this->_db->query('SELECT post_name FROM posts WHERE post_type="file" GROUP BY post_name');

		while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			$images[] = $donnees["post_name"];
		}

		return $images;
	}
	
	public function getPages()
	{
		
		$pages = [];

		$q = $this->_db->query('SELECT * FROM posts WHERE post_type="page" ORDER BY id');

		while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			$pages[] = new Article($donnees);
		}

		return $pages;
	}	
	
	public function getTitlePages()
	{
		
		$titles = [];

		$q = $this->_db->query('SELECT post_title, id FROM posts WHERE post_type="page" ORDER BY id');

		while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			$titles[] = array($donnees['post_title'],$donnees['id']);
		}

		return $titles;
	}
	
	public function getPageById($post_id)
	{
		$q = $this->_db->prepare('SELECT * FROM posts WHERE id =:post_id');
		$q->bindValue(':post_id', $post_id, PDO::PARAM_INT);
		$q->execute();

		$donnees = $q->fetch(PDO::FETCH_ASSOC);

		return new Article($donnees);
	}
	
	public function getFirstPageId()
	{
		$q = $this->_db->query('SELECT id FROM posts WHERE post_type="page" ORDER BY id');

		$donnees = $q->fetch(PDO::FETCH_ASSOC);

		return $donnees['id'];
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
	
	function updatePage($page)
	{
		$q = $this->_db->prepare("UPDATE posts
									SET post_title = :post_title,
										post_category = :post_category,
										post_content = :post_content,
										post_date = NOW()
									WHERE id = :id");

		$q->bindValue(':post_title', $page->post_title(), PDO::PARAM_STR);
		$q->bindValue(':post_category', $page->post_category(), PDO::PARAM_STR);
		$q->bindValue(':post_content', $page->post_content(), PDO::PARAM_STR);
		$q->bindValue(':id', $page->id(), PDO::PARAM_INT);
		
		return $q->execute();
	}	
	
	function updateFile($file)
	{
		$q = $this->_db->prepare("UPDATE posts
									SET post_name = :post_name,
										post_date = NOW()
									WHERE id = :id");

		$q->bindValue(':post_name', $file->post_name(), PDO::PARAM_STR);
		
		$q->bindValue(':id', $file->id(), PDO::PARAM_INT);
		
		return $q->execute();
	}
}


