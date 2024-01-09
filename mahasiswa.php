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
                      <a class="nav-link active text-white"  href="mahasiswa.php">Mahasiswa</a>
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
    <h3 class="text-center">MAHASISWA</h3>
    </div>

    <div class="card mt-3">
      <div class="card-header bg-dark text-white">
        Data Mahasiswa
      </div>
      <div class="card-body">

        <!-- fungsi untuk mencari mahasiswa -->
        <form method="POST">
          <div class="input-group mb-3 ">
            <input type="text" name="bcari"  class="form-control" placeholder="Cari mahasiswa">
            <button class="btn btn-primary" name="search" type="submit">Cari</button>
            <button class="btn btn-danger" name="reset" type="submit">Reset</button>
          </div>
        </form>

        <!-- Button tambah data -->
        <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#ModalTambah">
        Tambahkan data
        </button>
        
        <!-- kolom tabel mahasiswa -->
          <table class="table table-bordered table striped table-hover">
          <thead class="table-dark">
              <th>No.</th>
              <th>Nim.</th>
              <th>Nama lengkap.</th>
              <th>Alamat.</th>
              <th>Prodi.</th>
              <th>kd organisasi</th>
              <th>Aksi.</th>             
            </thead>

            <!-- fungsi untuk menampilkan data dari tabel mahasiswa -->
            <?php

            if (isset($_POST['bcari'])){
              $keyword = $_POST['bcari'];
              $q = "SELECT * FROM mahasiswa WHERE nim like '%$keyword' or nama like '%$keyword' ";
            }else{
              $q = "SELECT * FROM mahasiswa";
            }
            
            $no = 1;
            $tampil = mysqli_query($koneksi, $q);
            while($data = mysqli_fetch_array($tampil)):
            
            ?>

            <!-- memanggil variabel tabel mahasiswa -->
            <tr>
                <td><?=$no++ ?></td>
                <td><?=$data['nim']?></td>
                <td><?=$data['nama']?></td>
                <td><?=$data['alamat']?></td>
                <td><?=$data['prodi']?></td>
                <td><?=$data['kd_organisasi']?></td>
                <td>
                <a href="#" class="btn btn-warning " data-bs-toggle="modal" data-bs-target="#ModalUbah<?= $no ?>">Ubah</a>
                <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalHapus<?= $no ?>">Hapus</a>
            </td>
            </tr>

            <!--Awal Modal Ubah data-->
          <div class="modal fade" id="ModalUbah<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title fs-5" id="staticBackdropLabel">Form Data Mahasiswa</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="updatemahasiswa.php">
                  <input type="hidden" name="id_mahasiswa" value="<?= $data['id_mahasiswa']?>">

                <div class="modal-body">

                  <div class="mb-3">
                  <label class="form-label">NIM</label>
                  <input type="text" class="form-control" name="tnim" value="<?=$data ['nim']?>" placeholder="masukan NIM anda">
                  <div class="mb-3">
                  <label class="form-label">Nama Lengkap</label>
                  <input type="text" class="form-control" name="tnama" value="<?=$data ['nama']?>" placeholder="masukan nama lengkap anda">

                </div>

                  <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea class="form-control" name="talamat" rows="3"><?=$data ['alamat']?></textarea>
                  </div>

                </div>

                <div class="mb-3">

                    <label class="form-label">Jurusan</label>
                    <select class="form-select" name=tprodi>
                      <option value="<?=$data ['prodi']?>"><?=$data ['prodi']?><option>
                        <option value="S1 Teknik Informatika">S1 Teknik Informatika</option>
                        <option value="S1 Teknik Industri">S1 Teknik Industri</option>
                        <option value="S1 Teknik Elektro">S1 Teknik Elektro</option>
                    </select>

                </div>             
                </div>
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" name="bubah">ubah</button>
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>               
                </div>
                </form>
              </div>
            </div>
          </div> 
          <!--Akhir Modal Ubah-->

          <!--Awal Modal Hapus data-->
          <div class="modal fade" id="ModalHapus<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi Penghapusan Data</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="deletemahasiswa.php">

                  <input type="hidden" name="id_mahasiswa" value="<?= $data['id_mahasiswa']?>">

                <div class="modal-body">

                  <h5 class="text-center"> Apakah anda yakin ingin menghapus data ini? <br>
                  <span class="text-danger"><?= $data['nim']?> - <?= $data['nama']?></span>
                  </h5>
                              
                </div>

                  <div class="modal-footer">
                  <button type="submit" class="btn btn-light text-danger" name="bhapus">Hapus</button>
                  <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tidak</button>

                </div>
                </form>
              </div>
            </div>
          </div> 
          <!--Akhir Modal Hapus data-->

          
        <?php endwhile; ?>
        
    </table>

          <!--Awal Modal tambah data -->
          <div class="modal fade" id="ModalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title fs-5" id="staticBackdropLabel">Form Data Mahasiswa</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                  <form method="POST" action="createmahasiswa.php">
                <div class="modal-body">
                  
                  <div class="mb-3">
                  <label class="form-label">NIM</label>
                  <input type="text" class="form-control" name="tnim" placeholder="masukan NIM anda">
                  <div class="mb-3">
                  <label class="form-label">Nama Lengkap</label>
                  <input type="text" class="form-control" name="tnama" placeholder="masukan nama lengkap anda">

                </div>
                <div class="mb-3">
                  <label class="form-label">Alamat</label>
                  <textarea class="form-control" name="talamat" rows="3"></textarea>
                </div>
                </div>
                <div class="mb-3">
                  <label class="form-label">Jurusan</label>
                  <select class="form-select" name=tprodi>
                    <option><option>
                      <option value="S1 Teknik Informatika">S1 Teknik Informatika</option>
                      <option value="S1 Teknik Industri">S1 Teknik Industri</option>
                      <option value="S1 Teknik Elektro">S1 Teknik Elektro</option>
                </select>
                </div>
                <div class="mb-3">
                <label class="form-label">Organisasi</label>
                  <input type="text" class="form-control" name="tkd_organisasi" placeholder="masukan kode organisasi">
                </div>

                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" name="bsimpan">Simpan</button>
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>                 
                </div>
                </form>
              </div>
            </div>
          </div> 
          <!--Akhir Modal tambah data --> 
                            
        </div>
        </div>
      </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>