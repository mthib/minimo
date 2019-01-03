<?php
class PersonnagesRepository
{
  private $_db; // Instance de PDO
  
  public function __construct()
  {
    $this->setDb();
  }
  
  public function add(Personnage $perso)
  {
    $q = $this->_db->prepare('INSERT INTO personnages_v2(nom,type) VALUES(:nom, :type)');
    $q->bindValue(':nom', $perso->nom());
    $q->bindValue(':type', $perso->type());
    $q->execute();
    
    $perso->hydrate([
      'id' => $this->_db->lastInsertId(),
      'degats' => 0,
      'atout' => 4,
    ]);
  }
  
  public function count()
  {
    return $this->_db->query('SELECT COUNT(*) FROM personnages_v2')->fetchColumn();
  }
  
  public function delete(Personnage $perso)
  {
    $this->_db->exec('DELETE FROM personnages_v2 WHERE id = '.$perso->id());
  }
  
  public function exists($info)
  {
    if (is_int($info)) // On veut voir si tel personnage ayant pour id $info existe.
    {
      return (bool) $this->_db->query('SELECT COUNT(*) FROM personnages_v2 WHERE id = '.$info)->fetchColumn();
    }
    
    // Sinon, c'est qu'on veut vérifier que le nom existe ou pas.
    
    $q = $this->_db->prepare('SELECT COUNT(*) FROM personnages_v2 WHERE nom = :nom');
    $q->execute([':nom' => $info]);
    
    return (bool) $q->fetchColumn();
  }
  
  public function get($info)
  {
    if (is_int($info))
    {
      $q = $this->_db->query('SELECT * FROM personnages_v2 WHERE id = '.$info);
      $donnees = $q->fetch(PDO::FETCH_ASSOC);
      
      if($donnees['type'] == "guerrier") return new Guerrier($donnees);
      if($donnees['type'] == "magicien") return new Magicien($donnees);
    }
    else
    {
      $q = $this->_db->prepare('SELECT * FROM personnages_v2 WHERE nom = :nom');
      $q->execute([':nom' => $info]);
      $donnees = $q->fetch(PDO::FETCH_ASSOC);

      if($donnees['type'] == "guerrier") return new Guerrier($donnees);
      if($donnees['type'] == "magicien") return new Magicien($donnees);
    }
  }
  
  public function getList($nom)
  {
    $persos = [];
    
    $q = $this->_db->prepare('SELECT * FROM personnages_v2 WHERE nom <> :nom ORDER BY nom');
    $q->execute([':nom' => $nom]);
    
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      if($donnees['type'] == "guerrier") $persos[] = new Guerrier($donnees);
      if($donnees['type'] == "magicien") $persos[] = new Magicien($donnees);
    
    }
    
    return $persos;
  }
  
  public function update(Personnage $perso)
  {
    $q = $this->_db->prepare('UPDATE personnages_v2 SET degats = :degats , atout = :atout WHERE id = :id');
    
    $q->bindValue(':degats', $perso->degats(), PDO::PARAM_INT);
    $q->bindValue(':atout', $perso->atout(), PDO::PARAM_INT);
    $q->bindValue(':id', $perso->id(), PDO::PARAM_INT);
    
    $q->execute();
  }

  public function endort(Personnage $perso)
  {
    $q = $this->_db->prepare('UPDATE personnages_v2 SET timeEndormi = :timeEndormi WHERE id = :id');
    
    $q->bindValue(':timeEndormi', $perso->timeEndormi(), PDO::PARAM_INT);
    $q->bindValue(':id', $perso->id(), PDO::PARAM_INT);
    
    $q->execute();
  }
  
  public function setDb()
  {
    
	$db = new PDO('mysql:host=localhost;dbname=combat', 'root', '');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // On émet une alerte à chaque fois qu'une requête a échoué.
	$this->_db = $db;
  }
}