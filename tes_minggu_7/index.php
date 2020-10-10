<?php 

include "connection.php";

$siswa=$db->query("select * from siswa");
$data_siswa=$siswa->fetchAll();

if(isset($_POST['search']))
{
    $filter=$_POST['search'];
    $search=$db->prepare("select * from siswa where nama_siswa=? or sekolah=? or motivasi=?"); // PDO statement
    $search->bindValue(1,$filter,PDO::PARAM_STR);
    $search->bindValue(2,$filter,pdo::PARAM_STR);
    $search->bindValue(3,$filter,pdo::PARAM_STR);
    $search->execute();     

    $tampil_data=$search->fetchAll();
    $row=$search->rowCount();
  
}else{
    $data=$db->query("select * from siswa");
    $tampil_data=$data->fetchAll();
}

// team
$team=$db->query("select * from tim");
$data_team=$team->fetchAll();

if(isset($_POST['cari']))
{
    $filter_x=$_POST['cari'];
    $cari=$db->prepare("select * from tim where nama_tim=?"); // PDO statement
    $cari->bindValue(1,$filter_x,PDO::PARAM_STR);
    $cari->bindValue(2,$filter_x,pdo::PARAM_STR);
    $cari->bindValue(3,$filter_x,pdo::PARAM_STR);
    $cari->execute();     

    $tampil_data=$cari->fetchAll();
    $row=$cari->rowCount();
  
}else{
    $data=$db->query("select * from tim");
    $tampil_data=$data->fetchAll();
  
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tes Minggu 7</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-7">
              <!-- Tabel Siswa -->
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col" class="h3">Tabel Siswa</th>
                      </tr>
                    </thead>
                    <?php if(isset($row)) : ?>
                      <div class="alert alert-primary alert-dimissible fade-show" role="alert">
                      <p class="lead"><?php echo $row; ?>Data ditemukan</p>
                      <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      </div>
                    <?php endif; ?>
                    <thead>
                      <tr>
                        <th scope="col">Id Siswa</th>
                        <th scope="col">Nama Siswa</th>
                        <th scope="col">Sekolah</th>
                        <th scope="col">Motivasi</th>
                        <th scope="col">Opsi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($data_siswa as $key): ?>
                      <tr>
                        <td><?php echo $key["id_siswa"]; ?></td>
                        <td><?php echo $key["nama_siswa"]; ?></td>
                        <td><?php echo $key["sekolah"]; ?></td>
                        <td><?php echo $key["motivasi"]; ?></td>
                        <td><a class="btn btn-light" data-toggle="modal" data-target="#showModal">hapus</a>|<a class="btn btn-light" href="edit.php?id_siswa=<?php echo $key["id_siswa"]; ?>">edit</a></td>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
    <div class="container mt-3">
      <div class="row">
        <div class="col -6">
          <form class="col-7" action="input.php" method="POST">
            <p class="h3">Masukkan Data Siswa</p>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Nama Siswa</label>
                      <input type="text" name="nama_siswa" class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Sekolah</label>
                      <input type="text" name="sekolah" class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Motivasi</label>
                      <input type="text" name="motivasi" class="form-control">
                  </div>

                  <button type="submit" class="col-3 btn btn-primary">simpan</button>
              </form>
            </div>
              <div class="col-6">
              <h3 class="text-info">Cari Data Siswa</h3>
              <form class="from-inline" action="index.php" method="POST">
                  <input type="text" class="from-control" name="search" placeholder="masukkan nama atau sekolah">
                  <input type="submit" value="cari">
              </form>
  
              <form class="mt-2" action="index.php" method="post">
                  <input class="btn btn-outline-info" type="submit" value="Tampilkan Semua">
              </form>
          </div>
      </div>
    </div>
                  <!-- Modal -->
  <div class="modal"  id="showModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Hapus Tabel</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Apakah Anda Yakin Ingin Menghapus Data Tabel Ini ?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <a type="button" class="btn btn-primary" href="delete.php?id_siswa=<?php echo $key["id_siswa"]; ?>">Hapus</a>
        </div>
      </div>
    </div>
  </div>

  <br>
  <!-- team -->

  <div class="container">
        <div class="row">
            <div class="col-7">
              <!-- Tabel team -->
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col" class="h3">Tabel Team</th>
                      </tr>
                    </thead>
                    <?php if(isset($row)) : ?>
                      <div class="alert alert-primary alert-dimissible fade-show" role="alert">
                      <p class="lead"><?php echo $row; ?>Data ditemukan</p>
                      <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      </div>
                    <?php endif; ?>
                    <thead>
                      <tr>
                        <th scope="col">Id Team</th>
                        <th scope="col">Nama Team</th>
                        <th scope="col">Opsi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($data_team as $value): ?>
                      <tr>
                        <td><?php echo $value["id_tim"]; ?></td>
                        <td><?php echo $value["nama_tim"]; ?></td>
                        <td><a class="btn btn-light" data-toggle="modal" data-target="#showModal">hapus</a>|<a class="btn btn-light" href="edit.php?id_tim=<?php echo $value["id_tim"]; ?>">edit</a></td>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
    <!-- form team -->
    <div class="container mt-3">
      <div class="row">
        <div class="col -6">
          <form class="col-7" action="input.php" method="post">
            <p class="h3">Masukkan Data Team</p>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Nama Team</label>
                      <input type="text" name="nama_tim" class="form-control">
                  </div>

                  <button type="submit" class="col-3 btn btn-primary">simpan</button>
              </form>
            </div>
              <div class="col-6">
              <h3 class="text-info">Cari Data Siswa</h3>
              <form class="from-inline" action="index.php" method="POST">
                  <input type="text" class="from-control" name="search" placeholder="masukkan data team">
                  <input type="submit" value="cari">
              </form>
  
              <form class="mt-2" action="index.php" method="post">
                  <input class="btn btn-outline-info" type="submit" value="Tampilkan Semua">
              </form>
          </div>
      </div>
    </div>
                  <!-- Modal -->
  <div class="modal"  id="showModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Hapus Tabel</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Apakah Anda Yakin Ingin Menghapus Data Tabel Ini ?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <a type="button" class="btn btn-primary" href="delete.php?id_tim=<?php echo $value["id_tim"]; ?>">Hapus</a>
        </div>
      </div>
    </div>
  </div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>    
</body>
</html>