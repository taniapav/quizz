<?php
session_start();
include_once 'models/database.php';
include_once 'models/question.php';
include_once 'models/answers.php';
include_once 'models/users.php';
include_once 'models/result.php';
include_once 'controllers/questionController.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, user-scalable=no" />
        <title>Test-e-quizz</title>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"</script>
        <script src="assets/jquery-3.3.1.min.js"></script>
        <script src="assets/jquery.js"></script>

    </head>
    <body>
        <h1>Quizz Journée des Droits des Femmes</h1>
        <form method="POST" action="resultats.php">
            <h2>Prêts ?</h2>
            <p> Faîtes bien attention si vous cliquez sur une réponse elle sera validée !</p>
            <button type="button" name="next" id="0">Commencer le Quizz</button>
            <?php foreach ($questionsList as $question) { ?>
                <div class="question" id="card-<?= $question->id ?>">
                    <h2 class="h3"><?= $question->id ?> / 10 - <?= $question->question; ?></h2>
                    <?php
                    if ($question->picture) {
                        ?>
                        <img src="assets/img/imgQ8.jpg" class="img-thumbnail img-fluid" />
                        <?php
                    }
                    foreach ($answersList as $answer) {
                        if ($answer->idQuestion == $question->id) {
                            ?>
                            <input class="answer" data-answer="<?= $answer->isCorrect; ?>" type="radio" id="question<?= $answer->id; ?>" name="question<?= $answer->id; ?>" value="<?= $answer->id; ?>">
                            <label  data-iscorrect="<?= $answer->isCorrect; ?>" class="pl-3" for="question<?= $answer->id; ?>"><?= $answer->answer; ?></label>
                            <?php
                        }
                    }
                    if ($question->id == 10) {
                        ?>
                            <button type="submit" name="validate" class="btn btn-primary nextButton" id="<?= $question->id ?>">Valider</button>
                        <?php
                    } else {
                        ?>
                            <button type="button" name="next" class="btn btn-primary nextButton hidden" id="<?= $question->id ?>">Question suivante</button>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="saviezVous" id="description-<?= $question->id; ?>">
                <h3>Le saviez-vous ?</h3>
                <p><?= $question->description ?>.</p>
            </div>
            <?php
        }
        ?>
    </form>
</body>
</html>
