<?php

class Users_Dao
{
    private SQLite3 $db;

    public function __construct(SQLite3 $dbConnection)
    {
        $this->db = $dbConnection;
    }

    public function insertUser(Usuari $usuari)
    {
        $stmt = $this->db->prepare("INSERT INTO usuaris (username, password) VALUES (:usuariNom, :usuariPassword)");
        $stmt->bindValue(':usuariNom', $usuari->nom, SQLITE3_TEXT);
        $stmt->bindValue(':usuariPassword', $usuari->password, SQLITE3_TEXT);
        $stmt->execute();

        if ($this->db->changes() > 0) {
            $id = $this->db->lastInsertRowID();
            return new Usuari($usuari->nom, $usuari->password, $id);
        }

        return false;
    }
    public function loginUser(Usuari $usuari)
    {
        $stmt = $this->db->prepare("SELECT * FROM usuaris WHERE username = :usuariNom AND password = :usuariPassword");
        $stmt->bindValue(':usuariNom', $usuari->nom, SQLITE3_TEXT);
        $stmt->bindValue(':usuariPassword', $usuari->password, SQLITE3_TEXT);
        $res = $stmt->execute();
        $row = $res->fetchArray(SQLITE3_ASSOC);
        if ($row === false) {
            return false;
        }
        return new Usuari($row['username'], $row['password'], $row['id']);
    }

    public function insertPartida($id, $punts)
    {
        $stmt = $this->db->prepare("INSERT INTO partides (idUsuari, punts) VALUES (:idUsuari, :punts)");
        $stmt->bindValue(':idUsuari', $id, SQLITE3_INTEGER);
        $stmt->bindValue(':punts', $punts, SQLITE3_INTEGER);
        $stmt->execute();

        if ($this->db->changes() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getPartides()
    {
        $res = $this->db->query("SELECT p.*, u.username FROM partides p JOIN usuaris u ON u.id = p.idUsuari");
        $arr = [];
        while ($fila = $res->fetchArray(SQLITE3_ASSOC)) {
            $arr[] = $fila;
        }
        return $arr;
    }



}
?>