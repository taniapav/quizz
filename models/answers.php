<?php

class answers extends database {

//Attributs publics
    public $id = 0;
    public $answer = '';
    public $pictureAnswer = '';
    public $isCorrect = false;
    public $id_question = 0;

    public function __construct() {
        parent::__construct();
    }

    public function getAnswersList() {
        $listAnswers = array();
        $sql = 'SELECT `a`.`id`, `a`.`answer`, `a`.`pictureAnswer`, `a`.`isCorrect`, `a`.`id_pokfze_question` as `idQuestion` '
                . 'FROM `pokfze_answers` as `a`';
        $resquestAnswers = $this->db->prepare($sql);
        if ($resquestAnswers->execute()) {
            $listAnswers = $resquestAnswers->fetchAll(PDO::FETCH_OBJ);
        }
        return $listAnswers;
    }

    public function __destruct() {
        parent::__destruct();
    }

}