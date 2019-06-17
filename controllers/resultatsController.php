<?php

$resultAnswers = new result();
$user = new users();

$pushedAnswers = array();
if (isset($_POST['validate'])) {
    $nbQuestion = count($_POST);
    $user->birthdate = $_SESSION['birthdate'];
    $user->username = $_SESSION['username'];
    $user->gender = $_SESSION['gender'];
    $user->addUser();
    $question = 1;
    $resultAnswers->id_user = $user->id;
    foreach ($_POST as $value) {
        if ($question <= $nbQuestion - 1) {
            $resultAnswers->id_question = $question;
            $resultAnswers->id_answers = $value;
            $resultAnswers->insertResultQuestion();
            $question ++;
        }
    }
}
$ageSet = false;
$statError = array();
// On choisit l'id de la question
// Appel de la méthode permettant de récupérer les résultats des hommes
$countResultMen = $resultAnswers->countResultMen();
if ($countResultMen->total != 0) {
//$percentageMen correspond au pourcentage de réussite des hommes
    $percentageMen = ceil($countResultMen->good * 100 / $countResultMen->total);
} else {
    $percentageMen = 0;
}
// Appel de la méthode permettant de récupérer les résultats des femmes
$countResultWomen = $resultAnswers->countResultWomen();
//$percentageMen correspond au pourcentage de réussite des femmes
if ($countResultWomen->total != 0) {
    $percentageWomen = ceil($countResultWomen->good * 100 / $countResultWomen->total);
} else {
    $percentageWomen = 0;
}

//Appel de la méthode permettant d'afficher la totalité des résultats
$total = $resultAnswers->TotalResult();
//calcul du pourcentage total de réussite
$percentageTotal = ceil($total->good * 100 / $total->total);
$percentageBy1825 = 0;
$percentageByM18 = 0;
$percentageBy2540 = 0;
$percentageBy40200 = 0;
/*
 * Permet de connaitre le pourcentage de bonnes réponses en fonction de la tranche d'âge sélectionnée
 */
$resultAnswers->ageMin = 0;
$resultAnswers->ageMax = 18;
$countAnswerByAgeTotal = $resultAnswers->countAnswerByAge();
$countGoodAnswerByAgeTotal = $resultAnswers->countGoodAnswerByAge();
if (($countAnswerByAgeTotal != 0) && ($countGoodAnswerByAgeTotal != 0)) { //Si il y a des résultats
    $percentageByM18 = ceil(($countGoodAnswerByAgeTotal * 100) / $countAnswerByAgeTotal); //On calcule le pourcentage de réussite de la tranche d'âge
}
$resultAnswers->ageMin = 18;
$resultAnswers->ageMax = 25;
$countAnswerByAgeTotal = $resultAnswers->countAnswerByAge();
$countGoodAnswerByAgeTotal = $resultAnswers->countGoodAnswerByAge();
if (($countAnswerByAgeTotal != 0) && ($countGoodAnswerByAgeTotal != 0)) { //Si il y a des résultats
    $percentageBy1825 = ceil(($countGoodAnswerByAgeTotal * 100) / $countAnswerByAgeTotal); //On calcule le pourcentage de réussite de la tranche d'âge
}
$resultAnswers->ageMin = 25;
$resultAnswers->ageMax = 40;
$countAnswerByAgeTotal = $resultAnswers->countAnswerByAge();
$countGoodAnswerByAgeTotal = $resultAnswers->countGoodAnswerByAge();
if (($countAnswerByAgeTotal != 0) && ($countGoodAnswerByAgeTotal != 0)) { //Si il y a des résultats
    $percentageBy2540 = ceil(($countGoodAnswerByAgeTotal * 100) / $countAnswerByAgeTotal); //On calcule le pourcentage de réussite de la tranche d'âge
}
$resultAnswers->ageMin = 40;
$resultAnswers->ageMax = 200;
$countAnswerByAgeTotal = $resultAnswers->countAnswerByAge();
$countGoodAnswerByAgeTotal = $resultAnswers->countGoodAnswerByAge();
if (($countAnswerByAgeTotal != 0) && ($countGoodAnswerByAgeTotal != 0)) { //Si il y a des résultats
    $percentageBy40200 = ceil(($countGoodAnswerByAgeTotal * 100) / $countAnswerByAgeTotal); //On calcule le pourcentage de réussite de la tranche d'âge
}

$resultById = $resultAnswers->getResultByUserId();
?>