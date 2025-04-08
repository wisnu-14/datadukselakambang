<?php
require '../../app/controller/KeluargaController.php';
$id = $_GET['id'];
if(isset($id)){
    delete($id);
    echo "<script>
    alert('Data berhasil dihapus!');window.location.href='../layout/app.php?pages=data_keluarga';
    </script>";
}