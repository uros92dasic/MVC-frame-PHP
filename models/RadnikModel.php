<?php
namespace App\Models;
use App\Core\DatabaseConnection;

class RadnikModel{
    private $dbc;

    public function __construct(DatabaseConnection &$dbc){
        $this->dbc = $dbc;
    }

    public function getAll(): array{
        $sql = 'SELECT * FROM radnik;';
        $prep = $this->dbc->getConnection()->prepare($sql);
        $res = $prep->execute();
        $radniks = [];
        if($res){
            $radniks = $prep->fetchAll(\PDO::FETCH_OBJ);
        }
        return $radniks;
    }

    public function getById(int $radnikId) {
        $sql = 'SELECT * FROM radnik WHERE id_radnika = ?;';
        $prep = $this->dbc->getConnection()->prepare($sql);
        $res = $prep->execute([$radnikId]);
        $radnik=NULL;
        if($res){
            $radnik = $prep->fetch(\PDO::FETCH_OBJ);
        }
        return $radnik;
    }

    public function getByIme(string $ime) {
        $sql = 'SELECT * FROM radnik WHERE ime = ?;';
        $prep = $this->dbc->getConnection()->prepare($sql);
        $res = $prep->execute([$ime]);
        $radnik=NULL;
        if($res){
            $radnik = $prep->fetch(\PDO::FETCH_OBJ);
        }
        return $radnik;
    }

    public function getAllByIdOdeljenja(int $id_odeljenja): array{
        $sql = 'SELECT * FROM radnik WHERE id_odeljenja = ?;';
        $prep = $this->dbc->getConnection()->prepare($sql);
        $res = $prep->execute([$id_odeljenja]);
        $radniks = [];
        if($res){
            $radniks = $prep->fetchAll(\PDO::FETCH_OBJ);
        }
        return $radniks;
    }

    public function getAllByIdProjekta(int $id_proj): array{
        $sql = 'SELECT r.*, p.*
                FROM radnik r
                    INNER JOIN ucesce u ON r.Id_radnika = u.Id_radnika
                    INNER JOIN projekat p ON p.Id_projekta  = u.Id_projekta
                WHERE p.id_projekta = ?;';
        $prep = $this->dbc->getConnection()->prepare($sql);
        $res = $prep->execute([$id_proj]);
        $radniks = [];
        if($res){
            $radniks = $prep->fetchAll(\PDO::FETCH_OBJ);
        }
        return $radniks;
    }

    public function getByIdSefa(int $Sef_odeljenja) {
        $sql = 'SELECT r.*
                FROM radnik r
                    INNER JOIN odeljenje o ON r.Id_radnika = o.Sef_odeljenja
                WHERE o.Sef_odeljenja = ?;';
        $prep = $this->dbc->getConnection()->prepare($sql);
        $res = $prep->execute([$Sef_odeljenja]);
        $radnik = NULL;
        if($res){
            $radnik = $prep->fetch(\PDO::FETCH_OBJ);
        }
        return $radnik;
    }

    public function getPlata(int $id_odeljenje): array{
        $sql = 'SELECT plata
                FROM radnik r
                    INNER JOIN odeljenje o ON r.Id_odeljenja = o.Id_odeljenja
                WHERE o.Id_odeljenja = ?;';
        $prep = $this->dbc->getConnection()->prepare($sql);
        $res = $prep->execute([$id_odeljenje]);
        $radniks = [];
        if($res){
            $radniks = $prep->fetchAll(\PDO::FETCH_OBJ);
        }
        return $radniks;
    }
}