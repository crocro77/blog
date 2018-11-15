<?php

class ObjectModel
{
    // Attribut nécessaire à la connexion avec la base de données.
    public $db;

    /**
     * Permet de se connecter à la base de données dès l'instanciation de l'objet.
     * @param PDO Object $db La base de données
     */
    public function __construct($db)
    {
        $this->db = $db;
    }
}