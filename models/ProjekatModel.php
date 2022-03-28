<?php
namespace App\Models;
use App\Core\DatabaseConnection;

class ProjekatModel{
    private $dbc;

    public function __construct(DatabaseConnection &$dbc){
        $this->dbc = $dbc;
    }

    public function getAll(): array{
        $sql = 'SELECT * FROM projekat;';
        $prep = $this->dbc->getConnection()->prepare($sql);
        $res = $prep->execute();
        $projekats = [];
        if($res){
            $projekats = $prep->fetchAll(\PDO::FETCH_OBJ);
        }
        return $projekats;
    }

    public function getById(int $projekatId) {
        $sql = 'SELECT * FROM projekat WHERE id_projekta = ?;';
        $prep = $this->dbc->getConnection()->prepare($sql);
        $res = $prep->execute([$projekatId]);
        $projekat=NULL;
        if($res){
            $projekat = $prep->fetch(\PDO::FETCH_OBJ);
        }
        return $projekat;
    }

    public function getByIme(string $ime) {
        $sql = 'SELECT * FROM projekat WHERE ime_proj = ?;';
        $prep = $this->dbc->getConnection()->prepare($sql);
        $res = $prep->execute([$ime]);
        $projekat=NULL;
        if($res){
            $projekat = $prep->fetch(\PDO::FETCH_OBJ);
        }
        return $projekat;
    }

    public function getAllByIdRadnika(int $id_radnika): array{
        $sql = 'SELECT r.*, p.*
                FROM projekat p
                    INNER JOIN ucesce u ON p.Id_projekta = u.Id_projekta
                    INNER JOIN radnik r ON r.Id_radnika  = u.Id_radnika
                WHERE r.id_radnika = ?;';
        $prep = $this->dbc->getConnection()->prepare($sql);
        $res = $prep->execute([$id_radnika]);
        $radniks = [];
        if($res){
            $radniks = $prep->fetchAll(\PDO::FETCH_OBJ);
        }
        return $radniks;
    }
}