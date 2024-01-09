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
                <a class="navbar-nav nav-link" href="home.php">Home</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                        <a class="nav-link "  href="mahasiswa.php">Mahasiswa</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link active text-white" href="organisasi.php">Organisasi</a>
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
    <h3 class="text-center">ORGANISASI</h3>
    </div>

    
    <div class="card mt-3">
      <div class="card-header bg-dark text-white">
        Data Organisasi
      </div>
      <div class="card-body">

        <!-- Button tambah data organisasi -->
        <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#ModalTambahorganisasi">
        Tambahkan data
        </button>

        <!-- kolom tabel organisasi -->
        <table class="table table-bordered table striped table-hover">
            <thead class="table-dark">
              <th>No.</th>
              <th>Kd organisasi.</th>
              <th>Nama organisasi.</th>
              <th>jabatan.</th>
              <th>Aksi.</th>          
            </thead>

            <!-- fungsi untuk memanggil data yang ada di organisasi -->
            <?php
            
            $no = 1;
            $tampil = mysqli_query($koneksi, "SELECT * FROM organisasi WHERE kd_organisasi" );
            while($data = mysqli_fetch_array($tampil)):
            
            ?>

            <!-- memanggil variabel tabel organisasi -->
            <tr>
                <td><?=$no++ ?></td>
                <td><?=$data['kd_organisasi']?></td>
                <td><?=$data['nama_organisasi']?></td>
                <td><?=$data['jabatan']?></td>

               <!-- button hapus -->
                <td>
                <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalHapus<?= $no ?>">Hapus</a>
            </td>              
            </tr>

              <!--Awal Modal Hapus organisasi -->
              <div class="modal fade" id="ModalHapus<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                      <h5 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi Penghapusan Organisasi</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form method="POST" action="deleteorganisasi.php">

                      <input type="hidden" name="kd_organisasi" value="<?= $data['kd_organisasi']?>">

                      <div class="modal-body">

                      <h5 class="text-center"> Apakah anda yakin ingin menghapus data ini? <br>
                      <span class="text-danger"><?= $data['kd_organisasi']?> - <?= $data['nama_organisasi']?></span>
                      </h5>
                                  
                      </div>

                      <div class="modal-footer">
                          <button type="submit" class="btn btn-primary" name="bhapus">Hapus</button>
                          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
                      </div>
                      </form>
                  </div>
                  </div>
              </div> 
              <!--Akhir Modal Hapus organisasi-->

            <?php endwhile; ?>

            <!--Awal Modal tambah-->
            <div class="modal fade" id="ModalTambahorganisasi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title fs-5" id="staticBackdropLabel">Tambah Organisasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                    <form method="POST" action="createorganisasi.php">
                  <div class="modal-body">
                    
                    <div class="mb-3">
                    <label class="form-label">Kode organisasi</label>
                    <input type="text" class="form-control" name="tkd_organisasi" placeholder="masukan kode organisasi">
                    <div class="mb-3">
                    <label class="form-label">Nama organisasi</label>
                    <input type="text" class="form-control" name="tnama_organisasi" placeholder="masukan nama organisasi">
                    <div class="mb-3">
                    <label class="form-label">Jabatan</label>
                    <input type="text" class="form-control" name="tjabatan" placeholder="masukan nama jabatan anda">

                  
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="bsimpan">Simpan</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>                 
                  </div>
                  </form>
                </div>
              </div>
            </div> 
          <!--Akhir Modal tambah--> 
        
        </table>
                            
        </div>
       </div>
     </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>