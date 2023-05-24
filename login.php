<?php include_once 'extra/header.php' ?>
<?php

if (isset($_POST['submit'])) {
  $user = new User();
  $data = [];
  $err = '';

  $data['username'] = $_POST['username'];
  $data['password'] = $_POST['password'];

  $check = $user->validation($data['username'], $data['password']);

  if (!is_string($check)) {
    $res = $user->login($data);

    if ($res) {
      $_SESSION['user'] = $res;
      header("Location:" . ROOT . '/index.php');
    } else {
      $err = 'Username or password incorrect!';
    }
  }
}

?>



<main class="p-5">
  <div style="width: 100%;max-width: 500px;" class="px-3 py-4 container-fluid border rounded shadow">
    <h3 class="text-center">Login</h3>


    <?php if (isset($check)) if (is_string($check)) : ?>
      <div class="alert alert-danger" role="alert">
        <?= $check ?>
      </div>
    <?php endif ?>

    <?php if (!empty($err)) : ?>
      <div class="alert alert-danger" role="alert">
        <?= $err ?>
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



      <span>Don't have an account? <a href="<?= ROOT ?>/signup.php" class="text-decoration-none">Create here.</a></span>

      <button name="submit" type="submit" class="mt-3 w-100 btn btn-primary">Login</button>
    </form>
  </div>
</main>

<?php include_once 'extra/footer.php' ?>