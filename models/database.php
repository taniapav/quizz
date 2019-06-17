<?php

class dataBase {

    //L'attribut $db sera disponible dans ses enfants
    protected $db;

    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=quizz;charset=utf8', 'teamcss', 'teamcss');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function __destruct() {

    }

}
?>
