<?php include_once 'extra/header.php' ?>
<?php

if (!isset($_SESSION['user'])) {
  header("Location:" . ROOT . '/login.php');
  exit;
}

$visitor = new Visitor();
$id = $_GET['id']  ?? '';
if ($id != '') {
  $res = $visitor->fetch_single_visitor($id);
}

?>

<main class="mt-3">
  <h3 class="text-center">Visitor Detail</h3>
  <div class="container  p-3 border rounded shadow-sm mt-2">
    <div class="d-flex">
      <ul class="list-group w-50 rounded-0">
        <li class="list-group-item text-black">Visitor ID #</li>
        <li class="list-group-item text-black">Name</li>
        <li class="list-group-item text-black">Email</li>
        <li class="list-group-item text-black">Contact #</li>
        <li class="list-group-item text-black">Entered Date</li>
        <li class="list-group-item text-black">Exited Date</li>
        <li class="list-group-item text-black">Encoded By</li>
      </ul>

      <ul class="list-group w-50 rounded-0">
        <li class="list-group-item text-black-50"><?= $res['id_number'] ?></li>
        <li class="list-group-item text-black-50"><?= $res['name'] ?></li>
        <li class="list-group-item text-black-50"><?= $res['email'] ?></li>
        <li class="list-group-item text-black-50"><?= $res['contact'] ?></li>
        <li class="list-group-item text-black-50"><?= $res['entered_date'] ?></li>
        <li class="list-group-item text-black-50"><?= $res['exited_date'] ?? '.....' ?></li>
        <li class="text-capitalize list-group-item text-black-50"><?= $res['encode'] ?></li>
      </ul>
    </div>

    <div class="d-flex align-items-center justify-content-center gap-3 mt-3">
      <a class="btn btn-sm bg-secondary text-white" href="<?= ROOT ?>/listVisitor.php">Back to list</a>

      <?php if ($res['status'] == 0) : ?>

        <a class="btn btn-sm bg-primary disabled text-white" href="<?= ROOT ?>/action/exited.php?id=<?= $res['id'] ?>">Exited !</a>

      <?php else : ?>
        <a class="btn btn-sm bg-primary text-white" href="<?= ROOT ?>/action/exited.php?id=<?= $res['id'] ?>">Mark as Exited</a>
      <?php endif ?>



      <a class="btn btn-sm bg-success text-white" href="<?= ROOT ?>/editVisitor.php?id=<?= $id ?>">Edit</a>

      <a class="btn btn-sm bg-danger text-white" href="<?= ROOT ?>/action/delete.php?id=<?= $id ?>">Delete</a>
    </div>
  </div>
</main>

<?php include_once 'extra/footer.php' ?>