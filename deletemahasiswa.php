<?php

//panggil koneksi db
include "koneksi.php";

//memberi nama tombol hapus dengan (bhapus)
if (isset($_POST['bhapus'])) {

    //fungsi untuk menghapus data yang ada didalam data mahasiswa

    $hapus = mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE id_mahasiswa = '$_POST[id_mahasiswa]' ");
 
    //kondisi
    if ($hapus) {
        echo "<script>
                alert('Hapus Data Sukses!');
                document.location='mahasiswa.php';
             </script>";
    } else {
        echo "<script>
                alert('Hapus Data Gagal!');
                document.location='mahasiswa.php';
             </script>";
    }
}