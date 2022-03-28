<?php
namespace App\Controllers;

class ProjekatController extends \App\Core\Controller
{
    public function show($id)
    {
        $projekatModel = new \App\Models\ProjekatModel($this->getDatabaseConnection());
        $projekat = $projekatModel->getById($id);
        if(!$projekat){
            header('Location: /');
            exit;
        } //dopunicemo ovaj IF kasnije
        $this->set('projekat', $projekat);

        $radnikModel = new \App\Models\RadnikModel($this->getDatabaseConnection());
        $radniksInProjekat = $radnikModel->getAllByIdProjekta($id);
        $this->set('radniksInProjekat', $radniksInProjekat);
    }

    public function delete($id){
        die('Nije zavrsena implementacija brisanja...');
    }
}