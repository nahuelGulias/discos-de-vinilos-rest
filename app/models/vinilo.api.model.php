
<?php
require_once 'app/models/model.php';
class ViniloModel extends Model{

    public function getVinilos(){
        $query = $this->db->prepare('SELECT * FROM vinilos');
        $query->execute();
        $vinilos = $query->fetchAll(PDO::FETCH_OBJ);
        return $vinilos;
    }

    public function getViniloById($idVinilo){
        $query = $this->db->prepare('SELECT * FROM vinilos where id_vinilo= ?');
        $query->execute([$idVinilo]);
        $vinilo = $query->fetch(PDO::FETCH_OBJ);
        return $vinilo;
    }
}