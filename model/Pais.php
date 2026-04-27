<?php

class Pais
{
    public string $code;
    public string $nom;
    public bool $esCorrecte;

    public bool $esTest;

    public function __construct($code, $nom, $esCorrecte, $esTest)
    {
        $this->code = $code;
        $this->nom = $nom;
        $this->esCorrecte = $esCorrecte;
        $this->esTest = $esTest;
    }
}