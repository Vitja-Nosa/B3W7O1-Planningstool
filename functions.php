<?php

require("connection.php");

function getGames() {
    $conn = openDatabase();
    $query = "SELECT * FROM `games`";
    $result = $conn->prepare($query);
    $result->execute();
    return $result->fetchall();
}
function getGame($id) {
    $conn = openDatabase();
    $query = "SELECT * FROM `games` WHERE id = :id";
    $result = $conn->prepare($query);
    $result->bindParam(':id', $id);
    $result->execute();
    return $result->fetch();
}
function getPlannedGames() {
    $conn = openDatabase();
    $query = "SELECT * FROM `planned_games` ORDER BY `time`";
    $result = $conn->prepare($query);
    $result->execute();
    return $result->fetchall();
}
function getPlannedGame($id) {
    $conn = openDatabase();
    $query = "SELECT * FROM `planned_games` WHERE id = :id";
    $result = $conn->prepare($query);
    $result->bindParam(":id", $id);
    $result->execute();
    return $result->fetch();
}
function updatePlannedGame($name, $time, $explained, $players, $gameid, $id) {
    $conn = openDatabase();
    $query = "UPDATE `planned_games` SET `name` = :gameName, `time` = :start_time, `explained_by` = :explained_by, `players` = :players, `gameid` = :gameid WHERE id = :id";
    $result = $conn->prepare($query);
    $result->bindParam(':gameName', $name);
    $result->bindParam(':start_time', $time);
    $result->bindParam(':explained_by', $explained);
    $result->bindParam(':id', $id);
    $result->bindParam(':players', $players);
    $result->bindParam(':gameid', $gameid);
    $result->execute();
}
function deletePlannedGame($id) {
    $conn = openDatabase();
    $query = "DELETE FROM `planned_games` WHERE `id` = :id";
    $result = $conn->prepare($query);
    $result->bindParam(':id', $id);
    $result->execute();
}
function addPlannedGame($name, $time, $explained, $players, $gameid) {
    $conn = openDatabase();
    $query = "INSERT INTO `planned_games` (`id`, `name`, `time`, `explained_by`, `players`, `gameid`) VALUES (NULL, :gameName, :start_time, :explained_by, :players, :gameid)";
    $result = $conn->prepare($query);
    $result->bindParam(':gameName', $name);
    $result->bindParam(':start_time', $time);
    $result->bindParam(':explained_by', $explained);
    $result->bindParam(':players', $players);
    $result->bindParam(':gameid', $gameid);
    $result->execute();
}

function secureData($data) {
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>