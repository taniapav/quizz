<?php

class result extends database {

// Attribut public
    public $id = 0;
    public $id_user = 0;
    public $id_question = 0;
    public $id_answers = 0;
    public $ageMin = 0;
    public $ageMax = 0;

    public function __construct() {
        parent::__construct();
    }

    /*
     * Cette méthode permet de récupérer les résultats de l'utilisateur
     */

    public function getResultByUserId() {

        $query = 'SELECT COUNT(`id_pokfze_answers`) as `nbAnswers`, (SELECT COUNT(*) FROM `pokfze_question`) AS `nbQuestion` FROM `pokfze_result` INNER JOIN `pokfze_answers` ON `pokfze_result`.`id_pokfze_answers` =  `pokfze_answers`.id WHERE `pokfze_answers`.`isCorrect` = 1 AND `pokfze_result`.`id_pokfze_user` = :idUser';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':idUser', $this->id_user, PDO::PARAM_INT);
        $queryResult->execute();
        return $queryResult->fetch(PDO::FETCH_OBJ);
    }

    /*
     * Insertion du résultat de la question par rapport au choix de l'utilisateur
     */

    public function insertResultQuestion() {
        $sql = 'INSERT INTO `pokfze_result`(`id_pokfze_user`, `id_pokfze_question`, `id_pokfze_answers`) '
                . 'VALUES (:resultUserId,:resultQuestionId,:resultAnswersId)';
        $result = $this->db->prepare($sql);
        $result->bindValue(':resultUserId', $this->id_user, PDO::PARAM_INT);
        $result->bindValue(':resultQuestionId', $this->id_question, PDO::PARAM_INT);
        $result->bindValue(':resultAnswersId', $this->id_answers, PDO::PARAM_INT);
        return $result->execute();
    }

    /*
     * Cette méthode permet de récupérer les 10 meilleurs résultat
     */

    public function scoreRanking() {
        $query = 'SELECT COUNT(`id_pokfze_answers`) AS `score`, `id_pokfze_user`, `pokfze_user`.`username` '
                . 'FROM `pokfze_result` '
                . 'INNER JOIN `pokfze_answers` ON `pokfze_result`.`id_pokfze_answers` = `pokfze_answers`.`id` '
                . 'INNER JOIN `pokfze_user` ON `pokfze_result`.`id_pokfze_user` = `pokfze_user`.`id` '
                . 'WHERE `pokfze_answers`.`isCorrect` = 1 '
                . 'GROUP BY `pokfze_result`.`id_pokfze_user` '
                . 'ORDER BY `score` DESC '
                . 'LIMIT 10 OFFSET 0';
        $queryExecute = $this->db->query($query);
        return $queryExecute->fetch(PDO::FETCH_OBJ);
    }

    /*
     * Afficher les résultats par rapport a la question choisit
     * @return array()
     */

    public function displayResultByQuestion() {
        $listResultByQuestion = array();
        $sql = 'SELECT `pokfze_result`.`id`, `pokfze_result`.`id_pokfze_user`, `pokfze_result`.`id_pokfze_question`, `pokfze_result`.`id_pokfze_answers` FROM `pokfze_result` INNER JOIN `pokfze_question` ON `pokfze_result`.`id_pokfze_question` = `pokfze_question`.`id` WHERE `pokfze_result`.`id_pokfze_question` = :resultQuestionId';
        $result = $this->db->prepare($sql);
        $result->bindValue(':resultQuestionId', $this->id_question, PDO::PARAM_INT);
        if ($result->execute()) {
            $listResultByQuestion = $result->fetchAll(PDO::FETCH_OBJ);
        }
        return $listResultByQuestion;
    }

    /*
     * Cette méthode permet de récupérer la totalité des résultats des hommes
     */

    public function countResultMen() {
        $query = 'SELECT COUNT(*) AS `total`, (SELECT COUNT(*) AS `total` FROM `pokfze_result` LEFT JOIN `pokfze_answers` ON `pokfze_result`.`id_pokfze_answers` = `pokfze_answers`.`id` LEFT JOIN `pokfze_user` ON `pokfze_result`.`id_pokfze_user` = `pokfze_user`.`id` WHERE `pokfze_answers`.`isCorrect` = 1 AND `pokfze_user`.`gender` = 1) AS `good` FROM `pokfze_result` LEFT JOIN `pokfze_answers` ON `pokfze_result`.`id_pokfze_answers` = `pokfze_answers`.`id` LEFT JOIN `pokfze_user` ON `pokfze_result`.`id_pokfze_user` = `pokfze_user`.`id` WHERE `pokfze_user`.`gender` = 1';
        $countList = $this->db->query($query);
        $countResultMen = $countList->fetch(PDO::FETCH_OBJ);
        return $countResultMen;
    }

    /*
     * Cette méthode permet de récupérer la totalité des résultats des femmes
     */

    public function countResultWomen() {
        $query = 'SELECT COUNT(*) AS `total`, (SELECT COUNT(*) AS `total` FROM `pokfze_result` LEFT JOIN `pokfze_answers` ON `pokfze_result`.`id_pokfze_answers` = `pokfze_answers`.`id` LEFT JOIN `pokfze_user` ON `pokfze_result`.`id_pokfze_user` = `pokfze_user`.`id` WHERE `pokfze_answers`.`isCorrect` = 1 AND `pokfze_user`.`gender` = 0) AS `good` FROM `pokfze_result` LEFT JOIN `pokfze_answers` ON `pokfze_result`.`id_pokfze_answers` = `pokfze_answers`.`id` LEFT JOIN `pokfze_user` ON `pokfze_result`.`id_pokfze_user` = `pokfze_user`.`id` WHERE `pokfze_user`.`gender` = 0';
        $countList = $this->db->query($query);
        $countResultWomen = $countList->fetch(PDO::FETCH_OBJ);
        return $countResultWomen;
    }

    public function TotalResult() {
        $query = 'SELECT COUNT(*) AS `total`, (SELECT COUNT(*) AS `total` FROM `pokfze_result` LEFT JOIN `pokfze_answers` ON `pokfze_result`.`id_pokfze_answers` = `pokfze_answers`.`id`LEFT JOIN `pokfze_user` ON `pokfze_result`.`id_pokfze_user` = `pokfze_user`.`id` WHERE `pokfze_answers`.`isCorrect` = 1) AS `good` FROM `pokfze_result` LEFT JOIN `pokfze_answers` ON `pokfze_result`.`id_pokfze_answers` = `pokfze_answers`.`id` LEFT JOIN `pokfze_user` ON `pokfze_result`.`id_pokfze_user` = `pokfze_user`.`id`';
        $totalList = $this->db->query($query);
        $totalResult = $totalList->fetch(PDO::FETCH_OBJ);
        return $totalResult;
    }

    /*
     * total des réponses bonne ou fausse par tranche d'âge
     */

    public function countAnswerByAge() {
        $query = 'SELECT COUNT(*) AS `total` FROM `pokfze_result` LEFT JOIN `pokfze_answers` ON `pokfze_result`.`id_pokfze_answers` = `pokfze_answers`.`id` LEFT JOIN `pokfze_user` ON `pokfze_result`.`id_pokfze_user` = `pokfze_user`.`id` WHERE FLOOR( DATEDIFF(NOW(), `pokfze_user`.`birthdate`) / 365) BETWEEN :ageMin AND :ageMax';
        $countList = $this->db->prepare($query);
        $countList->bindValue(':ageMin', $this->ageMin, PDO::PARAM_INT);
        $countList->bindValue(':ageMax', $this->ageMax, PDO::PARAM_INT);
        if ($countList->execute()) {
            $countAnswerByAge = $countList->fetch(PDO::FETCH_OBJ);
        }
        return $countAnswerByAge->total;
    }

    /*
     * total des bonnes réponses par tranche d'âge
     */

    public function countGoodAnswerByAge() {
        $countGoodAnswerByAge = '';
        $query = 'SELECT COUNT(*) AS `good` FROM `pokfze_result` LEFT JOIN `pokfze_answers` ON `pokfze_result`.`id_pokfze_answers` = `pokfze_answers`.`id` LEFT JOIN `pokfze_user` ON `pokfze_result`.`id_pokfze_user` = `pokfze_user`.`id` WHERE `pokfze_answers`.`isCorrect` = 1 AND FLOOR( DATEDIFF(NOW(), `pokfze_user`.`birthdate`) / 365) BETWEEN :ageMin AND :ageMax';
        $countList = $this->db->prepare($query);
        $countList->bindValue(':ageMin', $this->ageMin, PDO::PARAM_INT);
        $countList->bindValue(':ageMax', $this->ageMax, PDO::PARAM_INT);
        if ($countList->execute()) {
            $countGoodAnswerByAge = $countList->fetch(PDO::FETCH_OBJ);
        }
        return $countGoodAnswerByAge->good;
    }

    public function __destruct() {
        parent::__destruct();
    }

}

