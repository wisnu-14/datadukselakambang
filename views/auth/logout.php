<?php
require '../../app/controller/AuthController.php';
session_start();
logoutUser();
header("Location: ../../");
exit;