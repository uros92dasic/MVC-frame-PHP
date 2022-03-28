<?php
namespace App\Controllers;

class MainController extends \App\Core\Controller {
    public function home(){
        $categoryModel = new \App\Models\OdeljenjeModel($this->getDatabaseConnection());
        $odeljenjes = $categoryModel->getAll();

        $this->set('odeljenjes', $odeljenjes);
    }
}