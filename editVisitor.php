<?php include_once 'extra/header.php' ?>

<?php
include_once './classes/Visitor.php';

if (!isset($_SESSION['user'])) {
  header("Location:" . ROOT . '/login.php');
  exit;
}

$visitor = new Visitor();

$id = $_GET['id'] ?? '';

if ($id != '') {
  $res = $visitor->fetch_single_visitor($id);
}


if (isset($_POST['submit'])) {
  $err = '';
  $success = '';
  $data['name'] = $_POST['name'] ?? '';
  $data['contact'] = $_POST['contact'] ?? '';
  $data['email'] = $_POST['email'] ?? '';
  $data['reason'] = $_POST['reason'] ?? '';
  $data['encode'] = $_SESSION['user']['role'];
  $data['id'] = $id;


  if (empty($data['name']) && empty($data['contact']) && empty($data['email']) && empty($data['reason'])) {
    $err = 'Please fill the all required fields!';
  }

  if (empty($err)) {


    $res = $visitor->update_visitor($data);
    if ($res) {
      header('Location:' . ROOT . '/listVisitor.php');
    }
  }
}


?>




<main class="mt-3 ">
  <h3 class="text-center">Edit Visitor</h3>

  <div class="container border rounded shadow p-3 mt-2">

    <!-- err message -->
    <?php if (!empty($err)) : ?>
      <div class="alert alert-danger" role="alert">
        <?= $err ?>
      </div>
    <?php endif ?>

    <!-- success message -->
    <?php if (!empty($success)) : ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success! </strong><?= $success ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif ?>


    <form method="post">

      <div class="mb-2">
        <label for="name" class="form-label mb-1">Name</label>
        <input value="<?= $res['name']  ?>" name="name" type="text" class="form-control" id="name">
      </div>

      <div class="mb-2">
        <label for="contact" class="form-label mb-1">Contact</label>
        <input value="<?= $res['contact'] ?>" name="contact" type="text" class="form-control" id="contact">
      </div>

      <div class="mb-2">
        <label for="email" class="form-label mb-1">Email</label>
        <input value="<?= $res['email'] ?>" name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp">
      </div>

      <div class="mb-2">
        <label for="reason" class="form-label mb-1">Reason</label>
        <textarea name="reason" rows="8" id="reason" class="form-control"><?= $res['reason'] ?></textarea>
      </div>

      <div class="d-flex justify-content-between">
        <a class="btn btn-secondary" href="<?= ROOT ?>/listVisitor.php">Back</a>

        <button name=" submit" type="submit" class="btn btn-primary">Edit</button>
      </div>
    </form>
  </div>
</main>

<?php include_once 'extra/footer.php' ?>