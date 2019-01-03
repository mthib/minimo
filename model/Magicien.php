<?php
require_once('model/Personnage.php');

class Magicien extends Personnage
{
    const PLUS_DE_MAGIE = 0; 
    const SORT_LANCE = 10; 

    public function lancerSort(Personnage $perso)
    {
        if ($perso->id() == $this->_id)
        {
            return parent::CEST_MOI;
        }

        if($perso->atout() == 0)
        {
            return self::PLUS_DE_MAGIE;
        }

        // endort pour 1 heure * atout
       /* $today = getdate();
        $dateEnSecondes = $today[0];*/
        $dateEnSecondes = time();
        $perso->_timeEndormi = $this->_atout * 3600 + 3600+ $dateEnSecondes;

        return self::SORT_LANCE;

    }

    public function recevoirDegats()
    {
        $this->_degats += 5;
        return parent::recevoirDegats();
    }
}