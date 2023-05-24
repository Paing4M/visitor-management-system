<?php
session_start();
require_once '../classes/config.php';

if (isset($_SESSION['user'])) {
  session_destroy();
  header("Location:" . ROOT . '/login.php');
}
