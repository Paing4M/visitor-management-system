<?php include_once 'extra/header.php' ?>

<?php

if (!isset($_SESSION['user'])) {
  header("Location:" . ROOT . '/login.php');
  exit;
}

$visitor = new Visitor();
$allVisitorCount = is_array($visitor->fetch_all_visitor()) ? count($visitor->fetch_all_visitor()) : 0;

$unexitedVisitorCount =
  is_array($visitor->fetch_unexited_visitor()) ? count($visitor->fetch_unexited_visitor()) : 0;

$exitedVisitorCount = is_array($visitor->fetch_exited_visitor()) ? count($visitor->fetch_exited_visitor()) : 0;


?>




<main class="mt-3">
  <h3 class="text-center">Welcome to my system</h3>
  <div class="mt-5">
    <div class="justify-content-center row g-0 gap-5">
      <div class=" card shadow col-md-4" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Visitor Today</h5>
          <div class="align-items-center card-text d-flex justify-content-between">
            <i class="text-primary fa-solid fa-users"></i>
            <p class="m-0"><?= $allVisitorCount ?></p>
          </div>
        </div>
      </div>

      <div class="card shadow col-md-4" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Unexited Visitor Today</h5>
          <div class="align-items-center card-text d-flex justify-content-between">
            <i class="text-primary fa-solid fa-users"></i>
            <p class="m-0"><?= $unexitedVisitorCount ?></p>
          </div>
        </div>
      </div>

      <div class="card shadow col-md-4" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Existed Visitor Today</h5>
          <div class="align-items-center card-text d-flex justify-content-between">
            <i class="fa-solid fa-right-from-bracket text-danger"></i>
            <p class="m-0"><?= $exitedVisitorCount ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php include_once 'extra/footer.php' ?>