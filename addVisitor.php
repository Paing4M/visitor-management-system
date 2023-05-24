<?php include_once 'extra/header.php' ?>

<?php
include_once './classes/Visitor.php';

if (!isset($_SESSION['user'])) {
  header("Location:" . ROOT . '/login.php');
  exit;
}

if (isset($_POST['submit'])) {
  $visitor = new Visitor();
  $err = '';
  $success = '';
  $data['id_number'] = $_POST['id_number'] ?? '';
  $data['name'] = $_POST['name'] ?? '';
  $data['contact'] = $_POST['contact'] ?? '';
  $data['email'] = $_POST['email'] ?? '';
  $data['reason'] = $_POST['reason'] ?? '';
  $data['status'] = 1;
  $data['encode'] = $_SESSION['user']['role'];


  if (empty($data['id_number']) && empty($data['name']) && empty($data['contact']) && empty($data['email']) && empty($data['reason'])) {
    $err = 'Please fill the all required fields!';
  }

  if (empty($err)) {

    $check = $visitor->check_exist_visitor_id($data['id_number']);
    if ($check) {
      $err = 'Visitor ID Number is already in use!';
    } else {
      $res = $visitor->add_visitor($data);
      if ($res) {
        $success = 'Add new visitor successfully!';
      }
    }
  }
}


?>




<main class="mt-3 ">
  <h3 class="text-center">Add New Visitor</h3>

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
        <label for="idNumber" class="form-label mb-1">ID Number</label>
        <input name='id_number' type="text" class="form-control" id="idNumber" aria-describedby="emailHelp">
      </div>

      <div class="mb-2">
        <label for="name" class="form-label mb-1">Name</label>
        <input name="name" type="text" class="form-control" id="name">
      </div>

      <div class="mb-2">
        <label for="contact" class="form-label mb-1">Contact</label>
        <input name="contact" type="text" class="form-control" id="contact">
      </div>

      <div class="mb-2">
        <label for="email" class="form-label mb-1">Email</label>
        <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp">
      </div>

      <div class="mb-2">
        <label for="reason" class="form-label mb-1">Reason</label>
        <textarea name="reason" rows="8" id="reason" class="form-control"></textarea>
      </div>

      <button name="submit" type="submit" class="btn btn-primary">Add</button>
    </form>
  </div>
</main>

<?php include_once 'extra/footer.php' ?>