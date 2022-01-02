<?php
    require("functions.php");
    if (!getPlannedGame($_GET['id'])) {
        header('Location:index.php');
        die();
    }
    if (isset($_POST['confirmed'])) {
        deletePlannedGame($_GET['id']);
        header('Location:index.php?deleted');
        die();
    }

    $plannedGame = getPlannedGame($_GET["id"]);
    $game = getGame($plannedGame["gameid"]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail pagina</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
    <?php
        if (isset($_GET['confirm'])) {
            echo '<div class="confirm-container">';
            echo '<div class="confirm-box">';
            echo '<p>Weet je zeker dat je deze planningsitem wilt verwijderen?</p>';
            printf('<form action="%s?id=%s" method="POST">', $_SERVER['PHP_SELF'], $_GET['id']);
            echo '<input type="submit" name="cancel" value="Annuleren">';
            echo '<input type="submit" name="confirmed" value="Bevestigen">';
            echo '</form>';
            echo '</div>';
            echo '</div>';           
        }
    ?>
    <div class="container">
        <a class="returnBtn" href="index.php"> < terug</a>
        <div class='content'>
            <?php
                printf('<a href="%s?id=%s&confirm">Verwijder</a>',$_SERVER['PHP_SELF'], $_GET['id']);
                printf('<br><a href="changeGame.php?id=%u">Aanpassen</a>', $_GET['id']);
                printf('<h1>%s</h1>', $game['name']);
                printf('<img src="images/%s" width="200" height="200">', $game['image']);
                echo $game['description'];
                echo $game['youtube'];
                printf('<a href="%s" style="display:block;">%s</a>', $game['url'], $game['url']);
                if ($game['expansions'] == NULL) {
                    $expansions = '-';
                }
                else {
                    $expansions = $game['expansions'];
                }
                echo '<ul>';
                printf('<li>Uitbereidingen: <strong>%s</strong></li>', $expansions);
                printf('<li>Vaardigheden: <strong>%s</strong></li>', $game['skills']);
                printf('<li>Minimale benodigde spelers: <strong>%s</strong></li>', $game['min_players']);
                printf('<li>Maximale aantal spelers: <strong>%s</strong></li>', $game['max_players']);
                printf('<li>Speel duur: <strong>%s min</strong></li>', $game['play_minutes']);
                printf('<li>Uitleg tijd: <strong>%s min</strong></li>', $game['explain_minutes']);
                echo '</ul>';
                echo '<ul>';
                printf('<li>Start tijd: <strong>%s</strong></li>', $plannedGame['time']);
                printf('<li>Uitlegger: <strong>%s</strong></li>', $plannedGame['explained_by']);
                printf('<li>Spelers: <strong>%s</strong></li>', $plannedGame['players']);
                echo '</ul>';
            ?>
        </div>
        
    </div>
</body>
</html>