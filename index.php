<?php
session_start();
include_once 'models/database.php';
include_once 'models/users.php';
include_once 'models/question.php';
include_once 'models/result.php';
include_once 'models/answers.php';
include_once 'controllers/questionController.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, user-scalable=no" />
        <title>Bienvenue</title>
    </head>
    <body>
        <h1>Quizz Journée des Droits des Femmes</h1>               
        <form action="#" method="POST">
            <h2>Avant de commencer</h2>
            <p>Quelques petites questions pour participer aux statistiques du quizz</p>
            <label for="username">Nom ou pseudo : </label>
            <input class="w-100" type="text" placeholder="Nom ou Pseudo" id="username" name="username" value="<?= $user->username != '' ? $user->username : ''; ?>"/>
            <p class="textError"><?= $textUsername ?></p>
            <label for="birthdate" >Date de naissance : </label>
            <input type="date" placeholder="TON AGE" name="birthdate" value="<?= $user->birthdate != '' ? $user->birthdate : ''; ?>"/>
            <p class="textError"><?= $textBirthdate ?></p>
            <p>Civilité : </p>
            <input type="radio" name="gender" id="man" value="man" <?= $user->gender == 1 && $checkGender ? 'checked' : ''; ?>>
            <label for="man">Monsieur</label>
            <input type="radio" name="gender" id="woman" value="woman" <?= $user->gender == 0 && $checkGender ? 'checked' : ''; ?>>
            <label for="woman">Madame</label>
            <p class="textError"><?= $textCheckbox ?></p>
            <input class="btn btn-primary register" name="register" type="submit" value="Valider" />
        </form>
    </body>
</html>
