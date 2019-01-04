<?php

abstract class Post
{
	protected	$id,
				$post_author,
				$post_title,
				$post_status,
				$post_name,
				$post_type;
		
  
	public function __construct(array $donnees)
	{
		$this->hydrate($donnees);
	}
	
	public function hydrate(array $donnees)
	{
		foreach ($donnees as $key => $value)
		{
			$method = 'set'.ucfirst($key);
		  
			if (method_exists($this, $method))
			{
				$this->$method($value);
			}
		}
	}

	public function id()
	{
		return $this->id;
	}		
	
	public function post_author()
	{
		return $this->post_author;
	}	
	
	public function post_title()
	{
		return $this->post_title;
	}
	
	public function post_status()
	{
		return $this->post_status;
	}

	public function post_name()
	{
		return $this->post_name;
	}
	
	public function post_type()
	{
		return $this->post_type;
	}
	
	public function setId($id)
	{
		$id = (int) $id;

		if ($id > 0)
		{
		  $this->id = $id;
		}
	}
	
	public function setPost_author($post_author)
	{
		$post_author = (int) $post_author;

		if ($post_author > 0)
		{
		  $this->post_author = $post_author;
		}
	}
	
	public function setPost_title($post_title)
	{
		if (is_string($post_title))
		{
		  $this->post_title = $post_title;
		}
	}	
	
	public function setPost_status($post_status)
	{
		if (is_string($post_status))
		{
		  $this->post_status = $post_status;
		}
	}	
	
	public function setPost_name($post_name)
	{
		if (is_string($post_name))
		{
		  $this->post_name = $post_name;
		}
	}	
	
	public function setPost_type($post_type)
	{
		if (is_string($post_type))
		{
		  $this->post_type = $post_type;
		}
	}
}