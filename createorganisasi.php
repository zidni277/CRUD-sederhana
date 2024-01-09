<?php

//panggil koneksi db
include "koneksi.php";

//memberi nama tombol simpan dengan (bsimpan)
if (isset($_POST['bsimpan'])) {

    //fungsi STORED PROCEDURE untuk menambahkan data ke tabel organisasi

    $simpan = mysqli_query($koneksi, "INSERT INTO organisasi (kd_organisasi, nama_organisasi, jabatan) 
    VALUES ('$_POST[tkd_organisasi]','$_POST[tnama_organisasi]','$_POST[tjabatan]')");

    
    //kondisi
    if ($simpan) {
        echo "<script>
                alert('Simpan Data Sukses!');
                document.location='organisasi.php';
             </script>";
    } else {
        echo "<script>
                alert('Simpan Data Gagal!');
                document.location='organisasi.php';
             </script>";
    }
}