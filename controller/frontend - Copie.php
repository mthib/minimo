<?php

// Chargement des classes
require_once('model/PersonnagesRepository.php');
require_once('model/Magicien.php');
require_once('model/Guerrier.php');

function login($message)
{
   $personnageRepository = new PersonnagesRepository();
	$nbPersonnages = $personnageRepository->count();
    require('view/loginView.php');
}

function usePersonnage(){
	$personnageRepository = new PersonnagesRepository();
	
	if ($personnageRepository->exists($_POST['nom'])) // Si celui-ci existe.
	  {
		$perso = $personnageRepository->get($_POST['nom']);
		$persos = $personnageRepository->getList($perso->nom());
		require('view/View.php');
	  }
	  else
	  {
		$message = 'Ce personnage n\'existe pas !'; // S'il n'existe pas, on affichera ce message.
		login($message);
	  }
	  
	  
}

function createPersonnage()
{
	$personnageRepository = new PersonnagesRepository();
	
	if( $_POST['type'] == "guerrier")
      $perso = new Guerrier(['nom' => $_POST['nom'], 'type' =>  $_POST['type']]); // On crée un nouveau personnage.
    elseif( $_POST['type'] == "magicien")
      $perso = new Magicien(['nom' => $_POST['nom'], 'type' =>  $_POST['type']]); // On crée un nouveau personnage.

    if (!$perso->nomValide())
    {
      $message = 'Le nom choisi est invalide.';
      unset($perso);
	  login($message);
    }
    elseif ($personnageRepository->exists($perso->nom()))
    {
      $message = 'Le nom du personnage est déjà pris.';
      unset($perso);
	  login($message);
    }
    else
    {
      $personnageRepository->add($perso);
	  $persos = $personnageRepository->getList($perso->nom());
		require('view/View.php');
    }

}

function frapper($perso)
{
	$personnageRepository = new PersonnagesRepository();


    if (!$personnageRepository->exists((int) $_GET['frapper']))
    {
      $message = 'Le personnage que vous voulez frapper n\'existe pas !';
    }
      else
      {
        $persoAFrapper = $personnageRepository->get((int) $_GET['frapper']);
        
        // On stocke dans $retour les éventuelles erreurs ou messages que renvoie la méthode frapper.
        $retour = $perso->frapper($persoAFrapper);
        
        
        switch ($retour)
        {
          case Personnage::CEST_MOI :
            $message = 'Mais... pourquoi voulez-vous vous frapper ???';
            break;
          
          case Personnage::PERSONNAGE_FRAPPE :
            $message = 'Le personnage a bien été frappé !';
            
            $personnageRepository->update($perso);
            $personnageRepository->update($persoAFrapper);
            
            break;
          
          case Personnage::PERSONNAGE_TUE :
            $message = 'Vous avez tué ce personnage !';
            
            $personnageRepository->update($perso);
            $personnageRepository->delete($persoAFrapper);
            
            break;
        }
      }
	  

  $persos = $personnageRepository->getList($perso->nom());
  require('view/View.php');
  
}

function lancerSort($perso)
{
	$personnageRepository = new PersonnagesRepository();

    if (!$personnageRepository->exists((int) $_GET['lancerSort']))
    {
      $message = 'Le personnage que vous voulez ensorceler n\'existe pas !';
    }
  
    else
    {
      $persoALancerSort = $personnageRepository->get((int) $_GET['lancerSort']);
       // On stocke dans $retour les éventuelles erreurs ou messages que renvoie la méthode frapper.
       $retour = $perso->lancerSort($persoALancerSort);
    }

    switch ($retour)
      {
        case Personnage::CEST_MOI :
          $message = 'Mais... pourquoi voulez-vous vous lancer un sort ???';
          break;
        
        case Magicien::PLUS_DE_MAGIE :
          $message = 'Vous n\'avez plus de magie';
          break;

         case Magicien::SORT_LANCE :
          $message = 'Le personnage a été ensorcelé';
          
          $personnageRepository->endort($persoALancerSort);
          
          break;
        
      }
  
  $persos = $personnageRepository->getList($perso->nom());
  require('view/View.php');
}