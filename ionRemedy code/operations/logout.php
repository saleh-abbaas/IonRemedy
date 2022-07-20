<?php

session_start();
unset($_SESSION["id_number"]);
session_destroy();
header("Location: ../index.php");