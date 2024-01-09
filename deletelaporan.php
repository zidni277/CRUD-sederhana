<?php

//panggil koneksi db
include "koneksi.php";

//memberi nama tombol hapus dengan (bhapus)
if (isset($_POST['bhapus'])) {

    //fungsi untuk menghapus data yang ada didalam laporan

    $hapus = mysqli_query($koneksi, "DELETE FROM laporan WHERE id_laporan = '$_POST[id_laporan]' ");
 
    //kondisi
    if ($hapus) {
        echo "<script>
                alert('Hapus Data Sukses!');
                document.location='laporan.php';
             </script>";
    } else {
        echo "<script>
                alert('Hapus Data Gagal!');
                document.location='laporan.php';
             </script>";
    }
}