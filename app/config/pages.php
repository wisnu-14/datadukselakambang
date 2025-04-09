<?php
error_reporting(1);
switch ($_GET['pages']) {
    case "home":
        require "../../views/home/index.php";
    break;
    case "data_keluarga":
        require "../../views/keluarga/index.php";
    break;
    case "edit_keluarga":
        require "../../views/keluarga/edit.php";
    break;
    
    case "data_penduduk":
        require "../../views/penduduk/index.php";
    break;
    case "edit_penduduk":
        require "../../views/penduduk/edit.php";
    break;

    case "data_barang":
        require "../../views/barang/index.php";
    break;
    case "edit_barang":
        require "../../views/barang/edit.php";
    break;

    case "kondisi_rumah":
        require "../../views/rumah/index.php";
    break;
    case "edit_kondisi_rumah":
        require "../../views/rumah/edit.php";
    break;

    case "kamar_mandi":
        require "../../views/kamar_mandi/index.php";
    break;
    case "edit_kamar_mandi":
        require "../../views/kamar_mandi/edit.php";
    break;

    case "data_listrik":
        require "../../views/listrik/index.php";
    break;
    case "edit_data_listrik":
        require "../../views/listrik/edit.php";
    break;

    case "data_ternak":
        require "../../views/ternak/index.php";
    break;
    case "edit_data_ternak":
        require "../../views/ternak/edit.php";
    break;

    case "tanaman_buah":
        require "../../views/buah/index.php";
    break;
    case "edit_tanaman_buah":
        require "../../views/buah/edit.php";
    break;

    case "tanaman_pangan":
        require "../../views/pangan/index.php";
    break;
    case "edit_tanaman_pangan":
        require "../../views/pangan/edit.php";
    break;

    case "tanaman_obat":
        require "../../views/obat/index.php";
    break;
    case "edit_tanaman_obat":
        require "../../views/obat/edit.php";
    break;

    case "data_air":
        require "../../views/air/index.php";
    break;
    case "edit_data_air":
        require "../../views/air/edit.php";
    break;
    
    case "data_usaha":
        require "../../views/usaha/index.php";
    break;
    case "edit_data_usaha":
        require "../../views/usaha/edit.php";
    break;

    case "rekap":
        require "../../views/rekap/rekap.php";
    break;
    case "export":
        require "../../views/rekap/export_excel.php";
    break;
}
