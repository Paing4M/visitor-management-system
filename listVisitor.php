<?php include_once 'extra/header.php' ?>
<?php
$visitor = new Visitor();
$res = [];

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

if (isset($_POST['filter'])) {
  $formDate = $_POST['fromDate'];
  $toDate = $_POST['toDate'];

  if (!empty($formDate) && !empty($toDate)) {

    $res = $visitor->fetch_all_visitor($row_per_page, $offset, $formDate, $toDate);
  }
} else if (isset($_POST['search'])) {
  $term = $_POST['searchTerm'];
  $res = $visitor->search_visitor($term, $row_per_page, $offset);
} else {

  $res = $visitor->fetch_all_visitor($row_per_page, $offset);
}


?>

<main class="mt-3">
  <h3 class="text-center">List Visitor</h3>
  <div class="container border rounded shadow p-3 mt-2">
    <form class="w-75 mx-auto d-flex gap-3 justify-content-center align-items-center" method="post">
      <div class="col-5">
        <label for="date" class="form-label m-0">Date Form</label>
        <input name="fromDate" type="date" class="form-control" id="date">
      </div>

      <div class="col-5">
        <label for="date1" class="form-label m-0">Date To</label>
        <input name="toDate" type="date" class="form-control" id="date1">
      </div>

      <button name="filter" class="btn mt-4 btn-primary" href=""><i class="fa-solid me-1 fa-filter"></i>Filter</button>
    </form>
    <hr>

    <div>
      <form method="post">
        <div class="rounded-full input-group  mb-3 w-75 mx-auto">
          <input name='searchTerm' type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
          <button name='search' class="input-group-text" id="inputGroup-sizing-sm"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
      </form>


      <div class="table-responsive">

        <?php if (!empty($res)) : ?>
          <table class="align-middle table-bordered shadow-sm table">
            <thead>
              <tr>
                <th class="text-center" scope="col">NO</th>
                <th class="text-center" scope="col">Entry Date</th>
                <th class="text-center" scope="col">Exit Date</th>
                <th class="text-center" scope="col">Visitor</th>
                <th class="text-center" scope="col">Status</th>
                <th class="text-center" scope="col">Action</th>
              </tr>
            </thead>
            <tbody>

              <!-- display all visitor -->
              <?php if (!empty($res)) : ?>
                <?php foreach ($res as $key => $visitor) : ?>
                  <tr>
                    <th class="text-center" scope="row"><a class="text-decoration-none text-black" href="<?= ROOT ?>/visitorDetail.php?id=<?= $visitor['id'] ?>"><?= $key + 1 ?></a></th>
                    <td class="text-center"><?= $visitor['entered_date'] ?></td>
                    <td class="text-center"><?= $visitor['exited_date'] ?? '.....' ?></td>
                    <td>
                      <a class="text-decoration-none" href="<?= ROOT ?>/visitorDetail.php?id=<?= $visitor['id'] ?>">
                        <p class="m-0 text-black"><?= $visitor['name'] ?></p>
                        <p class="small text-black-50 m-0">ID #:<?= $visitor['id_number'] ?></p>
                      </a>
                    </td>
                    <td class="text-center">
                      <?php if ($visitor['status'] ==   1) : ?>
                        <p class="mx-auto w-75 border rounded-lg  rounded-pill text-center m-0">Entered</p>
                      <?php else : ?>
                        <p class="mx-auto text-white bg-danger w-75 border rounded-lg  rounded-pill text-center m-0">Exited</p>
                      <?php endif ?>


                    </td>
                    <td class="text-center">
                      <div class="d-flex align-items-center justify-content-center gap-2">
                        <a class="btn bnt-sm border" href="<?= ROOT ?>/visitorDetail.php?id=<?= $visitor['id'] ?>"><i class="fa-solid text-primary fa-bars-staggered"></i></a>


                        <?php if ($visitor['status'] ==   1) : ?>
                          <a class="btn bnt-sm border" href="<?= ROOT ?>/action/exited.php?id=<?= $visitor['id'] ?>"><i class="fa-solid text-danger fa-right-from-bracket"></i></a>
                        <?php endif ?>


                        <a class="btn bnt-sm border" href="<?= ROOT ?>/editVisitor.php?id=<?= $visitor['id'] ?>"><i class="fa-regular text-success fa-pen-to-square"></i></a>

                        <a class="btn bnt-sm border" href="<?= ROOT ?>/action/delete.php?id=<?= $visitor['id'] ?>"><i class="text-danger fa-solid fa-trash-can"></i></a>

                      </div>
                    </td>
                  </tr>
                <?php endforeach ?>
              <?php endif ?>

            </tbody>
          </table>
        <?php else : ?>
          <p class="text-center text-danger">No visitor!<a class="text-decoration-none" href="<?= ROOT ?>/listVisitor.php"> Back...</a></p>
        <?php endif  ?>



        <div class="d-flex w-100 gap-3 justify-content-center align-items-center">
          <a class="btn btn-sm bg-primary text-white <?= $page <= 1 ? 'disabled' : '' ?>" href="?page=<?= $prev_page ?>">Prev</a>
          <a class="btn btn-sm bg-primary text-white <?= $page >= $total_no_page ? 'disabled' : '' ?>" href="?page=<?= $next_page ?>">Next</a>
        </div>

      </div>


    </div>

  </div>
</main>

<?php include_once 'extra/footer.php' ?>