<?php
require("./db.php");

if (isset($_SESSION['user'])) {
    unset($_SESSION['user']);
    exit;
}else {
    exit;
}