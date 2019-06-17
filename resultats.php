<?php
session_start();
include_once 'models/database.php';
include_once 'models/question.php';
include_once 'models/answers.php';
include_once 'models/users.php';
include_once 'models/result.php';
include_once 'controllers/resultatsController.php';
//data stats charts
$dataPoints = array(
    array("name" => "Bonnes réponses", "y" => ($percentageMen == 0 ? 0 : $percentageMen)),
    array("name" => "Mauvaises réponses", "y" => 100 - ($percentageMen == 0 ? 0 : $percentageMen))
);
$dataPoints2 = array(
    array("name" => "Bonnes réponses", "y" => ($percentageWomen == 0 ? 0 : $percentageWomen)),
    array("name" => "Mauvaises réponses", "y" => 100 - ($percentageWomen == 0 ? 0 : $percentageWomen))
);
$dataPoints3 = array(
    array("name" => "Bonnes réponses", "y" => ($percentageTotal == 0 ? 0 : $percentageTotal)),
    array("name" => "Mauvaises réponses", "y" => 100 - ($percentageTotal == 0 ? 0 : $percentageTotal))
);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Statistiques</title>
    </head>
    <body>
        <h1>Quizz Journée des Droits des Femmes</h1>
        <h2>Les statistiques </h2>
        <?php
        if ($resultAnswers->id_user != 0) {
            ?>
            <h3> Votre score est de : <?= $resultById->nbAnswers ?>/<?= $resultById->nbQuestion ?></h3>
            <?php
        }
        ?>
        <div class="row">
            <div class="col-md-4 d-flex justify-content-center mb-4">
                <div id="chartContainer" style="height: 20em; width:15em;"></div>
            </div>
            <div class="col-md-4 d-flex justify-content-center mb-4">
                <div id="chartContainer2" style="height: 20em; width:15em;"></div>
            </div>
            <div class="col-md-4 d-flex justify-content-center mb-4">
                <div id="chartContainer3" style="height: 20em; width:15em;"></div>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Tranche d'âges</th>
                    <th>Taux de réussite</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>-18</td>
                    <td><?= ($percentageByM18 == 0) ? 'Non défini' : $percentageByM18 . '%' ?></td>
                </tr>
                <tr>
                    <td>18-25</td>
                    <td><?= ($percentageBy1825 == 0) ? 'Non défini' : $percentageBy1825 . '%' ?></td>
                </tr>
                <tr>
                    <td>25-40</td>
                    <td><?= ($percentageBy2540 == 0) ? 'Non défini' : $percentageBy2540 . '%' ?></td>
                </tr>
                <tr>
                    <td>+40</td>
                    <td><?= ($percentageBy40200 == 0) ? 'Non défini' : $percentageBy40200 . '%' ?></td>
                </tr>
            </tbody>
        </table>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        <script type="text/javascript">
            window.onload = function () {
                CanvasJS.addColorSet("greenShades",
                        [//colorSet Array
                            "#4aacc5",
                            "#f79647"
                        ]);
                var chart = new CanvasJS.Chart("chartContainer", {
                    theme: "light2",
                    animationEnabled: true,
                    colorSet: "greenShades",
                    title: {
                        text: "Pourcentage de réussite pour les hommes"
                    },
                    legend: {
                        fontFamily: "calibri",
                        fontSize: 14,
                        itemTextFormatter: function (e) {
                            return 50 + "%";
                        }
                    },
                    data: [
                        {
                            legendMarkerType: "square",
                            legendText: "{name} : {y}%",
                            //     yValueFormatString: "#,##0.0\"%\"",
                            name: "réussite",
                            // radius: "100%",
                            showInLegend: true,
                            startAngle: 270,
                            type: "doughnut",
                            dataPoints:<?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                        }
                    ]
                });
                chart.render();

                var chart2 = new CanvasJS.Chart("chartContainer2", {
                    theme: "light2",
                    animationEnabled: true,
                    colorSet: "greenShades",
                    title: {
                        text: "Pourcentage de réussite pour les femmes"
                    },
                    legend: {
                        fontFamily: "calibri",
                        fontSize: 14,
                        itemTextFormatter: function (e) {
                            return 50 + "%";
                        }
                    },
                    data: [
                        {
                            legendMarkerType: "square",
                            legendText: "{name} : {y}%",
                            //     yValueFormatString: "#,##0.0\"%\"",
                            name: "réussite",
                            // radius: "100%",
                            showInLegend: true,
                            startAngle: 270,
                            type: "doughnut",
                            dataPoints:<?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
                        }
                    ]
                });
                chart2.render();

                var chart3 = new CanvasJS.Chart("chartContainer3", {
                    theme: "light2",
                    animationEnabled: true,
                    colorSet: "greenShades",
                    title: {
                        text: "Pourcentage de réussite global"
                    },
                    legend: {
                        fontFamily: "calibri",
                        fontSize: 14,
                        itemTextFormatter: function (e) {
                            return 50 + "%";
                        }
                    },
                    data: [
                        {
                            legendMarkerType: "square",
                            legendText: "{name} : {y}%",
                            //     yValueFormatString: "#,##0.0\"%\"",
                            name: "réussite",
                            // radius: "100%",
                            showInLegend: true,
                            startAngle: 270,
                            type: "pie",
                            dataPoints:<?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
                        }
                    ]
                });
                chart3.render();
            };
        </script>
    </body>
</html>
