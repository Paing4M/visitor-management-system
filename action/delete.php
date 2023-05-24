<?php

include_once '../classes/config.php';

$id = $_GET['id'];

if ($id) {
  $visitor = new Visitor();
  $res = $visitor->delete_visitor($id);
  if ($res) {
    header('Location: ' . ROOT . '/listVisitor.php');
  }
}
