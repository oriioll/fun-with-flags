<?php
class Usuari
{
    public ?int $id;
    public $nom;
    public $password;

    public function __construct($nom, $password, ?int $id = null)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->password = $password;
    }
}
?>