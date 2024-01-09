<?php

//panggil koneksi db
include "koneksi.php";

//memberi nama tombol simpan dengan (bsimpan)
if (isset($_POST['bsimpan'])) {

    //fungsi STORED PROCEDURE untuk menambahkan data ke tabel mahasiswa

    $simpan = mysqli_query($koneksi, "INSERT INTO mahasiswa (nim,nama,alamat,prodi,kd_organisasi) 
    VALUES ('$_POST[tnim]','$_POST[tnama]','$_POST[talamat]','$_POST[tprodi]','$_POST[tkd_organisasi]')");

    
    //kondisi
    if ($simpan) {
        echo "<script>
                alert('Simpan Data Sukses!');
                document.location='mahasiswa.php';
             </script>";
    } else {
        echo "<script>
                alert('Simpan Data Gagal!');
                document.location='mahasiswa.php';
             </script>";
    }
}