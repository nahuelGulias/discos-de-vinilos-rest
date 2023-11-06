
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

    public function insertarVinilo($nombre, $idArt, $precio, $anio){
        $query = $this->db->prepare('INSERT INTO vinilos (vinilo ,id_artista, precio, anio_lanzamiento) VALUES(?,?,?,?)');
        $query->execute([$nombre, $idArt, $precio, $anio]);
        return $this->db->lastInsertId();
    }
    
    public function modificarVinilo($precio, $id){
        $query= $this->db->prepare('UPDATE vinilos SET precio = ? WHERE vinilos.id_vinilo = ?');
        $query->execute([$precio, $id]);
    }

    public function ordenarAsc(){
        $query = $this->db->prepare('SELECT * FROM vinilos ORDER BY vinilos.id_vinilo ASC');
        $query->execute();
    }

    public function ordenarDesc(){
        $query = $this->db->prepare('SELECT * FROM vinilos ORDER BY vinilos.id_vinilo DESC');
        $query->execute();
    }
    
       
}