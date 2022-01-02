<?php
    require('functions.php');

    if (!getPlannedGame($_GET['id'])) {
        header('Location:index.php');
        die();
    }

    $error = false;

    if (isset($_POST["submit"])) {
        foreach ($_POST as $value) {
            if (empty($value)) {
                $error = "Alle velden moeten gevuld zijn.";
            }
        }
        $justDate = explode('T', $_POST['time']);
        if (strlen($justDate[0]) > 10 && $error == false) {
            $error = "Voer een geldige datum in.";
        }
        else if (!$error) {
            $gameid = $_POST['gameid'];
            $game = getGame($gameid);
            $gameName = $game['name'];
            $time = secureData($_POST["time"]);
            $explained_by = secureData($_POST["explained_by"]);
            $players = secureData($_POST["players"]);
            updatePlannedGame($gameName, $time, $explained_by, $players, $gameid, $_GET['id']);
            header("Location:index.php?change");
            die();
        }
    }

    $games = getGames();
    $plannedGame = getPlannedGame($_GET['id']);
    $game = getGame($plannedGame['gameid']);

    $fulldate = explode(' ', $plannedGame['time']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aanpas pagina</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <a class="returnBtn" href="index.php"> < terug</a>
        <?php if($error) {?>
            <div class="errorMsg"><?= $error ?></div>
        <?php } ?>
        <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="POST">
            <select class="block userInput" name="gameid">
                <?php foreach($games as $game) { ?>
                    <option value="<?= $game["id"]; ?>" <?php if ($game['name'] == $plannedGame['name']) { echo 'selected'; }?>><?php echo $game["name"]; ?> </option>
                <?php } ?>
            </select>
            <input id='date' class="block userInput" type="datetime-local" name="time" id="time" value='<?= $fulldate[0] . 'T' . $fulldate[1] ?>'>
            <input class="block userInput" type="text" name="explained_by" placeholder="uitlegger" value="<?= $plannedGame['explained_by'] ?>">
            <input class="block userInput" type="text" name="players" placeholder="spelers" value='<?= $plannedGame['players'] ?>'>
            <input class="block submitBtn" type="submit" name="submit" value="Aanpassen">
        </form>
    </div>
</body>
</html>