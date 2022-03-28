<?php
namespace App\Controllers;

class RadnikController extends \App\Core\Controller
{
    public function show($id)
    {
        $radnikModel = new \App\Models\RadnikModel($this->getDatabaseConnection());
        $radnik = $radnikModel->getById($id);
        if(!$radnik){
            header('Location: /');
            exit;
        } //dopunicemo ovaj IF kasnije
        $this->set('radnik', $radnik);

        $projekatModel = new \App\Models\ProjekatModel($this->getDatabaseConnection());
        $projekatsInRadnik = $projekatModel->getAllByIdRadnika($id);
        $this->set('projekatsInRadnik', $projekatsInRadnik);
    }

    public function delete($id){
        die('Nije zavrsena implementacija brisanja...');
    }
}