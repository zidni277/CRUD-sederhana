<?php

//panggil koneksi db
include "koneksi.php";

//memberi nama tombol ubah dengan (bubah)
if (isset($_POST['bubah'])) {

    //fungsi untuk mengupdate data yang ada didalam tabel mahasiswa

    $ubah = mysqli_query($koneksi, "UPDATE mahasiswa 
    SET nim = '$_POST[tnim]', nama = '$_POST[tnama]', alamat = '$_POST[talamat]', 
    prodi = '$_POST[tprodi]' WHERE id_mahasiswa ='$_POST[id_mahasiswa]' ");
    
    //kondisi
    if ($ubah) {
        echo "<script>
                alert('Ubah Data Sukses!');
                document.location='mahasiswa.php';
             </script>";
    } else {
        echo "<script>
                alert('Ubah Data Gagal!');
                document.location='mahasiswa.php';
             </script>";
    }
}