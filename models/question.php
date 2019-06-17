<?php

class question extends database {

//Attribut public
    public $id = 0;
    public $question = '';
    public $picture = '';
    public $description = '';

    public function __construct() {
        parent::__construct();
    }

    public function getQuestionsList() {
        $listQuestions = array();
        $sql = 'SELECT `id`, `question`, `picture` , `description` FROM `pokfze_question`';
        $result = $this->db->query($sql);
        $listQuestions = $result->fetchAll(PDO::FETCH_OBJ);
        return $listQuestions;
    }

    public function __destruct() {
        parent::__destruct();
    }

}