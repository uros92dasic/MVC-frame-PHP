<?php
namespace App\Models;
use App\Core\DatabaseConnection;

class OdeljenjeModel{
    private $dbc;

    public function __construct(DatabaseConnection &$dbc){
        $this->dbc = $dbc;
    }

    public function getAll(): array{
        $sql = 'SELECT * FROM odeljenje;';
        $prep = $this->dbc->getConnection()->prepare($sql);
        $res = $prep->execute();
        $odeljenjes = [];
        if($res){
            $odeljenjes = $prep->fetchAll(\PDO::FETCH_OBJ);
        }
        return $odeljenjes;
    }

    public function getById(int $odeljenjeId) {
        $sql = 'SELECT * FROM odeljenje WHERE id_odeljenja = ?;';
        $prep = $this->dbc->getConnection()->prepare($sql);
        $res = $prep->execute([$odeljenjeId]);
        $odeljenje=NULL;
        if($res){
            $odeljenje = $prep->fetch(\PDO::FETCH_OBJ);
        }
        return $odeljenje;
    }

    public function getByIme(string $ime) {
        $sql = 'SELECT * FROM odeljenje WHERE ime_od = ?;';
        $prep = $this->dbc->getConnection()->prepare($sql);
        $res = $prep->execute([$ime]);
        $odeljenje=NULL;
        if($res){
            $odeljenje = $prep->fetch(\PDO::FETCH_OBJ);
        }
        return $odeljenje;
    }
}