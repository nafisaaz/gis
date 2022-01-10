<?php
include('header3.php');
$users = $obj->getPoint();

if (isset($_POST['update'])) {

  $user = $obj->getPointById();
  $_SESSION['user'] = pg_fetch_object($user);
  header('location:edit.php');
}



if (isset($_POST['delete'])) {

  $ret_val = $obj->deletepoint();
  if ($ret_val == 1) {

    echo "<script language='javascript'>";
    echo "alert('Record Deleted Successfully'){
          window.location.reload();
      }";
    echo "</script>";
  }
}
?>
<div class="container">
  <br>
  <div class="row mb-1">
    <div class="position-relative">
      <div class="container position-relative">
        <div class=" container mt-1">
          <div class="container-fluid">
          <div class="row justify-content-center">
              <a href="insert.php" class="btn btn-primary pull-left mt-2 mb-4"> Add Record</a>
            </div>
            <div class="position-relative">
              <div class="container position-relative">
                <div class="row justify-content-center">
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr class="active">
                        <th>ID</th>
                        <th>Nama Hotel</th>
                        <th>Alamat Hotel</th>
                        <th>Jenis</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while ($user = pg_fetch_object($users)) : ?>
                        <tr align="left">
                          <td><?= $user->id ?></td>
                          <td><?= $user->nama ?></td>
                          <td><?= $user->alamat ?></td>
                          <td><?= $user->jenis ?></td>
                          <td><?= $user->lat ?></td>
                          <td><?= $user->lng ?></td>

                          <td>
                            <form method="post">
                              <input type="submit" class="btn btn-success" name="update" value="Update">
                              <input type="submit" onClick="return confirm('Please confirm deletion');" class="btn btn-danger" name="delete" value="Delete">
                              <input type="hidden" value="<?= $user->id ?>" name="id">
                            </form>
                      </td>
                        </tr>
                      <?php endwhile; ?>
                    </tbody>
                  </table>
                </div>

              </div>
            </div>
            <?php include('footer.php'); ?>