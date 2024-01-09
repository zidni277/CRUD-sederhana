<?php

//panggil koneksi
include "koneksi.php";

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tugas BDT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    
  <div class="container">
    <!-- navbar -->
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid bg-secondary">
          <a class="navbar-nav active text-white" href="#">Home</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="mahasiswa.php">Mahasiswa</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="organisasi.php">Organisasi</a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="laporan.php">Laporan</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- akhir navbar -->
    <div class="mt-3">
    <h3 class="text-center">DATA MAHASISWA</h3>
    <h3 class="text-center">Fakultas Teknologi Industri</h3>
    </div>

    
    <div class="card mt-3">
        <div class="card-header bg-dark text-white">
          Data Mahasiswa
        </div>
      <div class="card-body">

      <!-- button cari mahasiswa -->
        <form method="POST">
          <div class="input-group mb-3 ">
            <input type="text" name="bcari"  class="form-control" placeholder="Cari mahasiswa">
            <button class="btn btn-primary" name="search" type="submit">Cari</button>
            <button class="btn btn-danger" name="reset" type="submit">Reset</button>
          </div>
      </form>

      <!-- kolom tabel home -->
          <table class="table table-bordered table striped table-hover">
            <thead class="table-dark">
              <th>No.</th>
              <th>Nim.</th>
              <th>Nama lengkap.</th>
              <th>Alamat.</th>
              <th>Prodi.</th>
              <th>Organisasi.</th>
              <th>Jabatan.</th>             
            </thead>

            <!-- fungsi VIEW untuk mennampilkan data -->
            <?php

            if (isset($_POST['bcari'])){
              $keyword = $_POST['bcari'];
              $q = "SELECT * FROM data_mahasiswa WHERE nim like '%$keyword' or nama like '%$keyword' ";
            }else{
              $q = "SELECT * FROM data_mahasiswa";
            }
            
            $no = 1;
            $tampil = mysqli_query($koneksi, $q);
            while($data = mysqli_fetch_array($tampil)):
              
            ?>

            <!-- memanggil variabel dari VIEW yang telah dibuat-->
              <tr>
                  <td><?=$no++ ?></td>
                  <td><?=$data['nim']?></td>
                  <td><?=$data['nama']?></td>
                  <td><?=$data['alamat']?></td>
                  <td><?=$data['prodi']?></td>
                  <td><?=$data['nama_organisasi']?></td>
                  <td><?=$data['jabatan']?></td>             
              </tr>

            <?php endwhile; ?>

            <!-- fungsi STORED FUNCTION untuk mengetahui total data -->
            <?php
            $query = "SELECT totaldata() AS totdata";
            $result = $koneksi->query($query);
            if ($result){
             $row = $result->fetch_assoc();
             $totaldata = $row['totdata'];
            }else{
              echo "Error:" . $koneksi->error;
            }
            
            ?>
            <!-- Button total data -->
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
              Total Data
            </button>

            <!-- Modal untuk mencari total data -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>

                  <form method="POST" action="home.php">
                  <input type="hidden" name="totdata" value="<?= $totdata?>">
                  <div class="modal-body">

                    <div class="form-label">Total Data Mahasiswa: "<?=$totaldata ?>"</div>    
                  </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>               
                  </div>
                
                </div>
              </div>
            </div>
            <!-- akhir modal -->

           </table>                            
          </div>
        </div>
      </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>