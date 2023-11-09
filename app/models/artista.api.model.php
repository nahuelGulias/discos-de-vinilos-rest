
<?php
require_once 'app/models/model.php';
class ArtistaModel extends Model{

    public function getAllArtistas(){
        $query = $this->db->prepare('SELECT * FROM artistas');
        $query->execute();
        $artistas = $query->fetchAll(PDO::FETCH_OBJ);
        return $artistas;
    }

    public function getArtistaById($idArt){
        $query = $this->db->prepare('SELECT * FROM artistas WHERE artistas.id_artista = ?');
        $query->execute([$idArt]);
        $artista = $query->fetch(PDO::FETCH_OBJ);
        return $artista;
    }

    public function insertarArtista($artista,$anioNac,$descp) {
        $query = $this->db->prepare('INSERT INTO artistas (artista, anio_nac, descripcion) VALUES (?, ?, ?)' );
        $query->execute([$artista,$anioNac,$descp]);

        return $this->db->lastInsertId();

    }

    public function modificarArtista($desc, $idArt) {
        $query= $this->db->prepare('UPDATE artistas SET descripcion = ? WHERE artistas.id_artista = ?');
        $query->execute([$desc, $idArt]);

    }
    public function ordenar($campo, $orden){
        $query = $this->db->prepare("SELECT * FROM artistas ORDER BY $campo $orden");
        $query->execute();
        $items = $query->fetchAll(PDO::FETCH_OBJ);
        return $items;
    }

}