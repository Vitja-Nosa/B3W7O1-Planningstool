<?php 
require("functions.php");

$plannedGames = getPlannedGames();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home pagina</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <a class="addBtn" href="addGame.php">Plan spel</a>
        <?php 
            if (isset($_GET['added'])) {
                $feedback = '<div class="feedback-elem">Uw spel is ingepland.</div>';
            }
            else if (isset($_GET['change'])) {
                $feedback = '<div class="feedback-elem">Uw planningsitem is aangepast</div>';
            }
            else if  (isset($_GET['deleted'])) {
                $feedback = '<div class="feedback-elem">Uw planningsitem is verwijderd</div>';
            }
            if (isset($feedback)) {
                echo $feedback;
            }
        ?>
        <div class="plannedGames">
        <?php 
        if(empty($plannedGames)) { 
            echo "<span>Er zijn nog geen spellen ingepland.</span>";
        }
        else { 
            foreach($plannedGames as $value) {
                $duration = getGame($value["gameid"])["play_minutes"] + getGame($value["gameid"])["explain_minutes"];
        ?>
            <a href="plannedGame.php?id=<?= $value["id"] ?>">
                <div class="game_box">
                    <ul>
                        <li> <br> Spelnaam : <?= $value["name"] ?> </li>
                        <li> <br> Starttijd : <?= $value["time"] ?> </li>
                        <li> <br> Duur : <?= $duration ?> min </li>
                        <li> <br> Uitleger : <?= $value["explained_by"] ?> </li>
                    </ul>
                </div>
            </a>
        <?php
            }
        }
        ?>
            
        </div>
    </div>
    
</body>
</html>