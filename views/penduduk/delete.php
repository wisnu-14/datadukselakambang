<?php
require '../../app/controller/PendudukController.php';
$id = $_GET['id'];
if(isset($id)){
    delete($id);
    echo "<script>
    alert('Data berhasil dihapus!');window.location.href='../layout/app.php?pages=data_penduduk';
    </script>";
}