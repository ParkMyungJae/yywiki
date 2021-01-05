<?php
require("db.php");

$date = date("Y-m-d H:i:s");

$ip = $_POST['loginIP'];

$sql = "INSERT INTO `yy_wiki_ip`(`ip`, `connection_time`) VALUES (?, ?)";

$cnt = query($con, $sql, [$ip, $date]);

if ($cnt == 1) {
    $sql2 = "SELECT `ip` FROM `yy_wiki_ip` WHERE ip = $ip";

    $_SESSION['user'] = $ip;

    exit;
}
