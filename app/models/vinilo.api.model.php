
<?php
require_once 'app/models/model.php';
class ViniloModel extends Model{

    function getAllVinilos(){
        $query = $this->db->prepare('SELECT * FROM vinilos');
        $query->execute();
        $vinilos= $query->fetchAll(PDO::FETCH_OBJ);
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
        return $query->rowCount();
    }

    public function ordenar($campo, $orden){
        $query = $this->db->prepare("SELECT * FROM vinilos ORDER BY $campo $orden");
        $query->execute();
        $items = $query->fetchAll(PDO::FETCH_OBJ);
        return $items;
    }
    
       
}