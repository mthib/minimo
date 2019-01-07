<?php

class Comment 
{
	private	$post_id,
			$comment_name,
			$comment_date,
			$comment_email,
			$comment_content;
	
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
	
	public function post_id()
	{
		return $this->post_id;
	}
	
	public function comment_date()
	{
		return $this->comment_date;
	}	
	
	public function comment_name()
	{
		return $this->comment_name;
	}
	
	public function comment_email()
	{
		return $this->comment_email;
	}
	
	public function comment_content()
	{
		return $this->comment_content;
	}
		
	public function setPost_id($post_id)
	{
		$post_id = (int) $post_id;

		if ($post_id > 0)
		{
		  $this->post_id = $post_id;
		}
	}
	
	public function setComment_date($comment_date)
	{
		$this->comment_date = $comment_date;
	}
	
	public function setComment_name($comment_name)
	{
		if (is_string($comment_name))
		{
		  $this->comment_name = $comment_name;
		}
	}	
	
	public function setComment_email($comment_email)
	{
		if (is_string($comment_email))
		{
		  $this->comment_email = $comment_email;
		}
	}	
	
	public function setComment_content($comment_content)
	{
		if (is_string($comment_content))
		{
		  $this->comment_content = $comment_content;
		}
	}
}