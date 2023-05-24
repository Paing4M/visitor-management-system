<?php include_once './classes/config.php'   ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <!-- font awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

  <!-- nav -->
  <nav class="navbar navbar-expand-lg " style="background-color: #e3f2fd;">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?= ROOT ?>/">Visitor management</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse  justify-content-sm-between" id="navbarNav">
        <div>
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="<?= ROOT ?>/">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= ROOT ?>/addVisitor.php">+ Add record</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= ROOT ?>/listVisitor.php">Visitor List</a>
            </li>
            <li class="nav-item">
              <a href="<?= ROOT ?>/visitorReport.php" class="nav-link">Reports</a>
            </li>

          </ul>
        </div>

        <?php if (!empty($_SESSION['user'])) : ?>
          <div class="dropdown">
            <button class="btn text-capitalize dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?= $_SESSION['user']['role'] ?>
            </button>
            <ul class="dropdown-menu">
              <li><a class="text-decoration-none" href="<?= ROOT ?>/action/logout.php
              "><button class="dropdown-item" type="button">Logout</button></a></li>
            </ul>
          </div>
        <?php else : ?>
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="<?= ROOT ?>/login.php" class="nav-link">Login</a>
            </li>
          </ul>
        <?php endif ?>
      </div>


    </div>
  </nav>