<?php

class users extends database {

    public $id = 0;
    public $username = '';
    public $gender = 0;
    public $currentDate = '01/01/1970';
    public $birthdate = '01/01/1970';

    public function __construct() {
        parent::__construct();
    }

    public function addUser() {
        //On prépare la requête sql qui insert dans les champs selectionnés, les valeurs sont des marqueurs nominatifs
        $query = 'INSERT INTO `pokfze_user` (`birthdate`, `gender`, `username`, `currentDate`) VALUES (:birthdate, :gender, :username, NOW())';
        $responseRequest = $this->db->prepare($query);
        $responseRequest->bindValue(':username', $this->username, PDO::PARAM_STR);
        $responseRequest->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $responseRequest->bindValue(':gender', $this->gender, PDO::PARAM_INT);
        //Si l'insertion s'est correctement déroulée on retourne vrai
        $resultRequest = $responseRequest->execute();
        if ($resultRequest) {
            $this->id = $this->db->lastInsertId();
        }
        return $this->id;
    }

    public function __destruct() {
        parent::__destruct();
    }

}
