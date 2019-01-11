<?php

class User 
{
	private	$id,
			$user_login,
			$user_pass;
	
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
	
	public function user_login()
	{
		return $this->user_login;
	}	
	
	public function user_pass()
	{
		return $this->user_pass;
	}
	
	public function setId($id)
	{
		$id = (int) $id;

		if ($id > 0)
		{
		  $this->id = $id;
		}
	}
	
	public function setUser_login($user_login)
	{
		if (is_string($user_login))
		{
		  $this->user_login = $user_login;
		}
	}
	
	public function setUser_pass($user_pass)
	{
		if (is_string($user_pass))
		{
		  $this->user_pass = $user_pass;
		}
	}	
}