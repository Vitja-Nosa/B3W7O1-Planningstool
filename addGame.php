<?php
    require("functions.php");

    $games = getGames();

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
        if (!$error) {
            $gameid = $_POST['gameid'];
            $game = getGame($gameid);
            $gameName = $game['name'];
            $time = secureData($_POST["time"]);
            $explained_by = secureData($_POST["explained_by"]);
            $players = secureData($_POST["players"]);
            addPlannedGame($gameName, $time, $explained_by, $players, $gameid);
            header("Location:index.php?added");
            die();
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toevoeg pagina</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <a class="returnBtn" href="index.php"> < terug</a>
        <?php if($error) {?>
            <div class="errorMsg"><?= $error ?></div>
        <?php } ?>
        <form action="<?= $_SERVER["PHP_SELF"] ?>" method="POST">
            <select class="block userInput" name="gameid">
                <?php foreach($games as $game) { ?>
                    <option value="<?= $game["id"]; ?>"><?= $game["name"]; ?> </option>
                <?php } ?>
            </select>
            <input id='date' class="block userInput" type="datetime-local" name="time" id="time">
            <input class="block userInput" type="text" name="explained_by" placeholder="uitlegger">
            <input class="block userInput" type="text" name="players" placeholder="spelers">
            <input class="block submitBtn" type="submit" name="submit" value="Voeg toe">
        </form>
    </div>
</body>
</html>