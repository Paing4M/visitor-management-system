<?php include_once 'extra/header.php' ?>
<?php

if (isset($_POST['submit'])) {
  $user = new User();
  $err = '';
  $data = [];

  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';
  $password2 = $_POST['password2'] ?? '';

  $check = $user->validation($username, $password, $password2);

  if (!is_string($check)) {
    $data['username'] = $username;
    $data['password'] = password_hash($password, PASSWORD_DEFAULT);

    $checkUsername = $user->check_username($data['username']);

    if ($checkUsername) {
      $check = "Username is already taken!";
    } else {

      $res = $user->signup($data);
      if ($res) {
        header("Location:" . ROOT . '/login.php');
      }
    }
  }
}

?>



<main class="p-5">
  <div style="width: 100%;max-width: 500px;" class="px-3 py-4 container-fluid border rounded shadow">
    <h3 class="text-center">Signup</h3>

    <?php if (isset($check)) if (is_string($check)) : ?>
      <div class="alert alert-danger" role="alert">
        <?= $check ?>
      </div>
    <?php endif ?>

    <form method="post">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input name="username" type="text" class="form-control" id="username">
      </div>

      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input name="password" type="password" class="form-control" id="exampleInputPassword1">
      </div>

      <div class="mb-3">
        <label for="exampleInputPassword2" class="form-label">Confirm Password</label>
        <input name="password2" type="password" class="form-control" id="exampleInputPassword2">
      </div>

      <span>Already have an account? <a href="<?= ROOT ?>/login.php" class="text-decoration-none">Login here.</a></span>

      <button name="submit" type="submit" class="mt-3 w-100 btn btn-primary">Signup</button>
    </form>
  </div>
</main>

<?php include_once 'extra/footer.php' ?>