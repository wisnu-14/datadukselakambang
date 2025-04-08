<?php
require '../../vendor/autoload.php'; 
require '../../app/database/connection.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

try {
    // Ambil No Rumah dari parameter
    $no_rumah = isset($_GET['no_rumah']) ? $_GET['no_rumah'] : '';

    // Buat file Excel baru
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Daftar tabel dan nama sheet
    $dataSheets = [
        'data_keluarga' => ['no_rumah', 'nama_pemilik', 'no_kk1', 'nama_kk1', 'no_kk2', 'nama_kk2', 'no_kk3', 'nama_kk3', 'alamat', 'rt', 'rw', 'no_telp', 'luas_tanah', 'sertifikat', 'belum_sertifikat', 'pemukiman', 'pertanian', 'pekarangan', 'pkh', 'sembako', 'rtlh', 'blt', 'lainnya'],
        'kondisi_rumah' => ['no_rumah', 'bangunan', 'terbuat_dari', 'keadaan', 'foto'],
        'kamar_mandi' => ['no_rumah', 'bangunan', 'jenis', 'keadaan', 'foto'],
        'listrik' => ['no_rumah', 'jenis', 'daya', 'menyalur_ke'],
        'barang' => ['no_rumah', 'nama_barang', 'jumlah'],
        'buah' => ['no_rumah', 'nama_buah', 'jumlah'],
        'obat' => ['no_rumah', 'nama_obat', 'jumlah'],
        'pangan' => ['no_rumah', 'nama_pangan', 'jumlah'],
        'sumber_air' => ['no_rumah', 'sumber_air', 'keterangan'],
        'ternak' => ['no_rumah', 'nama_ternak', 'jumlah'],
        'usaha' => ['no_rumah', 'nama_usaha', 'keterangan']
    ];

    $rowNumber = 1;

    foreach ($dataSheets as $table => $columns) {
        // Tambahkan judul tabel
        $sheet->setCellValue("A$rowNumber", strtoupper(str_replace('_', ' ', $table)));
        $sheet->getStyle("A$rowNumber")->getFont()->setBold(true)->setSize(14);
        $rowNumber++;

        // Tambahkan header kolom
        $colLetter = 'A';
        $sheet->setCellValue("$colLetter$rowNumber", "No");
        $colLetter++;

        foreach ($columns as $colName) {
            $sheet->setCellValue("$colLetter$rowNumber", ucwords(str_replace('_', ' ', $colName)));
            $colLetter++;
        }

        // Styling untuk header
        $headerRange = "A$rowNumber:$colLetter$rowNumber";
        $sheet->getStyle($headerRange)->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4F81BD']
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => '000000']]
            ]
        ]);

        $rowNumber++;

        // Ambil data dari database dengan filter No Rumah
        $sql = "SELECT * FROM $table";
        if (!empty($no_rumah)) {
            $sql .= " WHERE no_rumah = :no_rumah";
        }
        $stmt = $pdo->prepare($sql);

        if (!empty($no_rumah)) {
            $stmt->bindParam(':no_rumah', $no_rumah, PDO::PARAM_STR);
        }

        $stmt->execute();
        $no = 1;
        $startRow = $rowNumber;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $colLetter = 'A';
            $sheet->setCellValue("$colLetter$rowNumber", $no);
            $colLetter++;

            foreach ($columns as $field) {
                $value = $row[$field] ?? '';

                // Format nomor KK sebagai teks agar tidak berubah ke notasi ilmiah
                if (is_numeric($value) && strlen($value) > 15) {
                    $sheet->setCellValueExplicit("$colLetter$rowNumber", $value, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                } else {
                    $sheet->setCellValue("$colLetter$rowNumber", $value);
                }

                $colLetter++;
            }

            $rowNumber++;
            $no++;
        }

        // Terapkan border ke seluruh data
        $dataRange = "A$startRow:$colLetter" . ($rowNumber - 1);
        $sheet->getStyle($dataRange)->applyFromArray([
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => '000000']]
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_CENTER
            ]
        ]);

        // Auto-size setiap kolom
        foreach (range('A', $colLetter) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Beri jarak antar tabel
        $rowNumber += 2;
    }

    // Set nama file
    $filename = "Data_Sensus_Selakambang_" . date('Y-m-d') . ".xlsx";

    // Bersihkan output buffer sebelum mengirim header
    if (ob_get_length()) ob_end_clean();

    // Atur header untuk download
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=\"$filename\"");
    header('Cache-Control: max-age=0');

    // Simpan ke output
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit();
} catch (Exception $e) {
    echo "Terjadi kesalahan: " . $e->getMessage();
}
