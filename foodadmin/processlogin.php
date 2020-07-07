<?php 
include_once("config/config.php");
$login = mysqli_real_escape_string($mysqli, trim($_POST["username"]));
$pwd = mysqli_real_escape_string($mysqli, trim($_POST["password"]));
$results = $mysqli->query("SELECT * FROM admin where status='1'");
while ($record = $results->fetch_assoc()) {
    if ($login == $record["username"] && $pwd == $record["password"]) {
        $_SESSION["ulogin"] = $record["username"];
        $_SESSION["status"] = $record["status"];
        $_SESSION["role"] = $record["role"];
        if ($record["status"] == 1) {
            $_SESSION["utype"] = "active";
            header("Location:home.php?uid=" . $record["status"]);
            exit;
        }
    }
}
header("Location:index.php?invalid=1");
?>
