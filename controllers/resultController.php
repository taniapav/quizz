<?php

// Initialiser la classe result()
$result = new result();
$ageSet = false;
$statError = array();
// On choisit l'id de la question
// Appel de la méthode permettant de récupérer les résultats des hommes
$countResultMen = $result->countResultMen();
//$percentageMen correspond au pourcentage de réussite des hommes
$percentageMen = ceil($countResultMen->good * 100 / $countResultMen->total);
// Appel de la méthode permettant de récupérer les résultats des femmes
$countResultWomen = $result->countResultWomen();
//$percentageMen correspond au pourcentage de réussite des femmes
$percentageWomen = ceil($countResultWomen->good * 100 / $countResultWomen->total);
//Appel de la méthode permettant d'afficher les résultats par question
$listResultByQuestion = $result->displayResultByQuestion();
//Appel de la méthode permettant d'afficher la totalité des résultats
$total = $result->TotalResult();
//calcul du pourcentage total de réussite
$percentageTotal = ceil($total->good * 100 / $total->total);
//Calcul du nombre d'hommes et de femmes dans la totalité des bonnes réponses
$numberMenInGoodAnswer = floor($countResultMen->good * 100 / $total->good);
$numberWomenInGoodAnswer = floor($countResultWomen->good * 100 / $total->good);
/*
 * Permet de connaitre le pourcentage de bonnes réponses en fonction de la tranche d'âge sélectionnée
 */
$ageMin = '';
$ageMax = '';
if (isset($_POST['submit'])) {
    if (!empty($_POST['ageMin'])) {
        $result->ageMin = $_POST['ageMin'];
    }
    if (!empty($_POST['ageMax'])) {
        $result->ageMax = $_POST['ageMax'];
    }
    if (isset($_POST['ageMin']) && isset($_POST['ageMax'])) {
        //Méthode qui permet de récupérer le nombre de bonnes réponses en fonction de la tranche d'âge
        $countAnswerByAgeTotal = $result->countAnswerByAge();
        $countGoodAnswerByAgeTotal = $result->countGoodAnswerByAge();
        if ($countAnswerByAgeTotal && $countGoodAnswerByAgeTotal) {
            $ageSet = true;
        }
    } else {
        $statError['noAgeSet'] = 'Veuillez préciser un âge';
    }
    if (($countAnswerByAgeTotal != 0) && ($countGoodAnswerByAgeTotal != 0)) { //Si il y a des résultats
        $percentageByAge = ceil(($countGoodAnswerByAgeTotal * 100) / $countAnswerByAgeTotal); //On calcule le pourcentage de réussite de la tranche d'âge
    } else {
        $statError['calcAge'] = 'Il n\'y a aucun résultat';
    }
}
