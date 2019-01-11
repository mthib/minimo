<?php

require_once('Post.php');

class Article extends Post
{
	private	$post_date,
			$post_content,
			$post_category;
			
	public function post_date()
	{
		return $this->post_date;
	}	
	
	public function post_content()
	{
		return $this->post_content;
	}	
	
	public function post_category()
	{
		return $this->post_category;
	}
	
	public function setPost_date($post_date)
	{
		$this->post_date = $post_date;
	}

	public function setPost_content($post_content)
	{
		if (is_string($post_content))
		{
		  $this->post_content = $post_content;
		}
	}
	
	public function setPost_category($post_category)
	{
		if (is_string($post_category))
		{
		  $this->post_category = $post_category;
		}
	}	
}