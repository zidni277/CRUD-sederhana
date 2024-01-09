<?php

//panggil koneksi db
include "koneksi.php";

//memberi nama tombol hapus dengan (bhapus)
if (isset($_POST['bhapus'])) {

    //fungsi untuk menghapus data yang ada didalam organisasi

    $hapus = mysqli_query($koneksi, "DELETE FROM organisasi WHERE kd_organisasi = '$_POST[kd_organisasi]' ");
 
    //kondisi
    if ($hapus) {
        echo "<script>
                alert('Hapus Data Sukses!');
                document.location='organisasi.php';
             </script>";
    } else {
        echo "<script>
                alert('Hapus Data Gagal!');
                document.location='organisasi.php';
             </script>";
    }
}