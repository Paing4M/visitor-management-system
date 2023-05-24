<?php include_once 'extra/header.php' ?>

<?php

if (!isset($_SESSION['user'])) {
  header("Location:" . ROOT . '/login.php');
  exit;
}

$visitor = new Visitor();

//pagination
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 1;
}
$row_per_page = 5;
$offset = ($page - 1) * $row_per_page;
$prev_page = $page - 1;
$next_page = $page + 1;
$total_count = count($visitor->fetch_all_visitor());
$total_no_page = ceil($total_count / $row_per_page);


$results =  $visitor->fetch_all_visitor($row_per_page, $offset);

?>

<main class="mt-3">

  <h3 class="text-center">
    Visitor Report
  </h3>

  <div class="container p-3 rounded border shadow mt-2">
    <div></div>
    <hr>

    <table class="table align-middle table-bordered">
      <thead>
        <tr>
          <th class="text-center" scope="col">NO</th>
          <th class="text-center" scope="col">Entry Date</th>
          <th class="text-center" scope="col">Exit Date</th>
          <th class="text-center" scope="col">Visitor</th>
          <th class="text-center" scope="col">Reason</th>
          <th class="text-center" scope="col">Encoded by</th>
        </tr>
      </thead>
      <tbody>

        <?php if (isset($results)) : ?>
          <?php foreach ($results as $key => $result) : ?>
            <tr>
              <th class="text-center" scope="row"><?= $key + 1 ?></th>
              <td class="text-center"><?= $result['entered_date'] ?></td>
              <td class="text-center"><?= $result['exited_date'] ?? '.....' ?></td>
              <td>
                <div class="text-black-50">
                  <p class="m-0">ID #:<?= $result['id_number'] ?></p>
                  <p class="m-0 text-black"><?= $result['name'] ?></p>
                  <p class="m-0 ">Contact #:<?= $result['contact'] ?></p>
                  <p class="m-0 "><?= $result['email'] ?></p>
                </div>
              </td>
              <td class="text-center"><?= $result['reason'] ?></td>
              <td class="text-center"><?= $result['encode'] ?></td>
            </tr>
          <?php endforeach ?>
        <?php else : ?>
          <div>
            <p class="text-dander">No visitor!</p>
          </div>
        <?php endif  ?>


      </tbody>
    </table>

    <div class="d-flex w-100 gap-3 justify-content-center align-items-center">
      <a class="btn btn-sm bg-primary text-white <?= $page <= 1 ? 'disabled' : '' ?>" href="?page=<?= $prev_page ?>">Prev</a>
      <a class="btn btn-sm bg-primary text-white <?= $page >= $total_no_page ? 'disabled' : '' ?>" href="?page=<?= $next_page ?>">Next</a>
    </div>
  </div>
</main>

<?php include_once 'extra/footer.php' ?>