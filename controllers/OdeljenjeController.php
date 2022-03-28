<?php
namespace App\Controllers;

class OdeljenjeController extends \App\Core\Controller
{
    public function show($id)
    {
        $categoryModel = new \App\Models\OdeljenjeModel($this->getDatabaseConnection());
        $odeljenje = $categoryModel->getById($id);
        if(!$odeljenje){
            header('Location: /');
            exit;
        } //dopunicemo ovaj IF kasnije
        $this->set('odeljenje', $odeljenje);

        $radnikModel = new \App\Models\RadnikModel($this->getDatabaseConnection());
        $radniksInOdeljenje = $radnikModel->getAllByIdOdeljenja($id);
        $this->set('radniksInOdeljenje', $radniksInOdeljenje);

        $sefOdeljenjaModel = new \App\Models\RadnikModel($this->getDatabaseConnection());
        if($odeljenje->Sef_odeljenja != null) {
            $sefOdeljenja = $sefOdeljenjaModel->getByIdSefa($odeljenje->Sef_odeljenja);
            $this->set('sefOdeljenja', $sefOdeljenja);
        } else {
            $this->set('sefOdeljenja', array());
        }

        $maxPlata = $this->getMaxPlata($id);
        $this->set('maxPlata', $maxPlata);
    }

    private function getMaxPlata($id_odeljenja){
        $odeljenjeModel = new \App\Models\RadnikModel($this->getDatabaseConnection());
        $plate = $odeljenjeModel->getPlata($id_odeljenja);
        $maxPlata = 0;
        foreach ($plate as $plata){
            if ($maxPlata < $plata->plata){
                $maxPlata = $plata->plata;
            }
        }
        return $maxPlata;
    }

    public function delete($id){
        die('Nije zavrsena implementacija brisanja...');
    }
}