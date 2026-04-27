<?php
class Partida
{
    public ?int $idPartida;
    public $idUsuari;
    public $punts;
    public ?string $data;

    public function __construct($idUsuari, $punts, ?string $data = null, ?int $idPartida = null)
    {
        $this->idPartida = $idPartida;
        $this->idUsuari = $idUsuari;
        $this->punts = $punts;
        $this->data = $data;
    }
}
