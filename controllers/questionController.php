<?php

$resultAnswer = new result();
$answers = new answers();
$answersList = $answers->getAnswersList();

$questions = new question();
$questionsList = $questions->getQuestionsList();
$user = new users();
//regex pour le prénom, accepte les prénom simple d'une taille minimum de 2 caractères sans importances sur la cast et les prénoms composé de 2 caractère par partie
$regexUsername = '/^[éèàëêîïa-z0-9]{2,20}$/i';
$checkUsername = false;
$checkBirthdate = false;
$checkGender = false;
$checkInsert = false;
$textBirthdate = '';
$textUsername = '';
$textCheckbox = '';
//Vérification de l'existance du pseudo
if (isset($_POST['register'])) {
    if (!empty($_POST['username'])) {
//si il existe on l'hydrate dans l'objet users
        $user->username = trim(strip_tags($_POST['username']));
//vérification du format du pseudo.
        if (preg_match($regexUsername, $user->username)) {
            $textUsername = '';
            $checkUsername = true;
        } else {
            $textUsername = 'Ce n\'est pas reconnu comme pseudo, recommencez !';
            $checkUsername = false;
        }
    }
    if (!empty($_POST['birthdate'])) {
        $user->birthdate = $_POST['birthdate'];
        list($year, $month, $day) = explode('-', $user->birthdate);
        $day = intval($day);
        $month = intval($month);
        $year = intval($year);
        if (checkdate($month, $day, $year)) {
            $checkBirthdate = true;
        } else {
            $checkBirthdate = false;
            $textBirthdate = 'Vérifier le format de la date';
        }
    } else {
        $textBirthdate = 'Vérifier le format de la date';
    }
    if (!empty($_POST['gender'])) {
        if ($_POST['gender'] == 'man') {
            $user->gender = 1;
            $checkGender = true;
        } elseif ($_POST['gender'] == 'woman') {
            $user->gender = 0;
            $checkGender = true;
        }
    }else{
        $textCheckbox ='choisissez votre civilité!';
    }
//si tout est valide on effectue l'insertion de l'utilisateur dans la base de donnée.
    if ($checkBirthdate && $checkUsername && $checkGender) {
        $_SESSION['username'] = $user->username;
        $_SESSION['birthdate'] = $user->birthdate;
        $_SESSION['gender'] = $user->gender;
        $checkInsert = true;
        header('Location: question.php');
    } elseif (isset($_POST['register'])) {
        
    }
}