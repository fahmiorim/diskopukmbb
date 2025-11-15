<?php

namespace App\Controllers\Admin;

use App\Models\M_settings;
use App\Models\M_pengumuman;
use App\Models\M_daftar;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Pendaftar extends BaseController
{
    public function __construct()
    {
        $this->M_settings = new M_settings();
        $this->M_pengumuman = new M_pengumuman();
        $this->M_daftar = new M_daftar();
        $this->db = \Config\Database::connect();
    }

    public function pengumuman($id)
    {
        $data = array(
            'title' => 'PENDAFTAR',
            'title2' => $this->M_settings->first(),
            'pengumuman' => $this->M_pengumuman->where('id', $id)->first(),
            'pendaftaran' => $this->M_daftar->where('id_pengumuman', $id)->orderBy('id', 'Asc')->join('3fi_kecamatan', '3fi_kecamatan.kecamatan_kode = 3fi_daftar.kecamatan_kode')->join('3fi_desa', '3fi_desa.desa_kode = 3fi_daftar.desa_kode')->findAll(),
            'isi' => 'admin/pendaftar/v_list',
        );
        echo view('admin/layout/v_wrapper', $data);
    }

    public function lihat($id)
    {
        $data = array(
            'title' => 'PENDAFTAR',
            'title2' => $this->M_settings->first(),
            'daftar' => $this->M_daftar->where('id', $id)->join('3fi_kecamatan', '3fi_kecamatan.kecamatan_kode = 3fi_daftar.kecamatan_kode')->join('3fi_desa', '3fi_desa.desa_kode = 3fi_daftar.desa_kode')->findAll(),
            'isi' => 'admin/pendaftar/v_pendaftar',
        );
        echo view('admin/layout/v_wrapper', $data);
    }

    public function export($id)
    {
        $daftar =  $this->M_daftar->where('id_pengumuman', $id)->join('3fi_pengumuman', '3fi_pengumuman.id = 3fi_daftar.id_pengumuman')->findAll();
        $jumlah =  $this->M_daftar->asArray()->where('id_pengumuman', $id)->countAllResults();
        $pengumuman = $this->M_pengumuman->where('id', $id)->first();
        $spreadsheet = new Spreadsheet();
        $file_name = ROOTPATH . '../public_html/public/media/upload/' . date('Y-m-d-H:i:s') . '-Data-Pendaftar.xlsx';

        $style_col = [
            'font' => ['bold' => true], // Set font nya jadi bold
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = [
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];


        $sheet = $spreadsheet->getActiveSheet();

        $sheet->mergeCells('C1:E1');
        $sheet->getStyle('A5')->applyFromArray($style_col);
        $sheet->getStyle('B5')->applyFromArray($style_col);
        $sheet->getStyle('C5')->applyFromArray($style_col);
        $sheet->getStyle('D5')->applyFromArray($style_col);
        $sheet->getStyle('E5')->applyFromArray($style_col);
        $sheet->getStyle('F5')->applyFromArray($style_col);
        $sheet->getStyle('G5')->applyFromArray($style_col);
        $sheet->getStyle('H5')->applyFromArray($style_col);
        $sheet->getStyle('I5')->applyFromArray($style_col);
        $sheet->getStyle('J5')->applyFromArray($style_col);
        $sheet->getStyle('K5')->applyFromArray($style_col);
        $sheet->getStyle('L5')->applyFromArray($style_col);
        $sheet->getStyle('M5')->applyFromArray($style_col);
        $sheet->getStyle('N5')->applyFromArray($style_col);
        $sheet->getStyle('O5')->applyFromArray($style_col);
        $sheet->getStyle('P5')->applyFromArray($style_col);
        $sheet->getStyle('Q5')->applyFromArray($style_col);
        $sheet->getStyle('R5')->applyFromArray($style_col);
        $sheet->getStyle('S5')->applyFromArray($style_col);

        $sheet->setCellValue('B1', 'Judul Pendaftaran :');
        $sheet->setCellValue('C1', $pengumuman['form_judul']);

        $sheet->setCellValue('B2', 'Tanggal Export :');
        $sheet->setCellValue('C2',  date('Y-m-d-H:i:s'));

        $sheet->setCellValue('B3', 'Jumlah Pendaftar :');
        $sheet->setCellValue('C3',  $jumlah . " Orang");

        $sheet->setCellValue('A5', 'No');
        $sheet->setCellValue('B5', 'Nama Lengkap');
        $sheet->setCellValue('C5', 'NIK');
        $sheet->setCellValue('D5', 'Email Aktif');
        $sheet->setCellValue('E5', 'No HP / WA');
        $sheet->setCellValue('F5', 'Alamat');
        $sheet->setCellValue('G5', 'Kecamatan');
        $sheet->setCellValue('H5', 'Desa');
        $sheet->setCellValue('I5', 'Alamat Sama dengan KTP');
        $sheet->setCellValue('J5', 'Tanggal Lahir');
        $sheet->setCellValue('K5', 'Jenis Kelamin');
        $sheet->setCellValue('L5', 'Agama');
        $sheet->setCellValue('M5', 'Status');
        $sheet->setCellValue('N5', 'Pendidikan');
        $sheet->setCellValue('O5', 'Pekerjaan');
        $sheet->setCellValue('P5', 'Pengalaman petugas sensus');
        $sheet->setCellValue('Q5', 'Penempatan 1');
        $sheet->setCellValue('R5', 'Penempatan 2');
        $sheet->setCellValue('S5', 'Deskripsi');

        $count = 6;
        $no = 1;


        foreach ($daftar as $row) {
            $sheet->setCellValue('A' . $count, $no++);
            $sheet->setCellValue('B' . $count, $row['name']);
            $sheet->setCellValue('C' . $count, "'" . $row['nik']);
            $sheet->setCellValue('D' . $count, $row['email']);
            $sheet->setCellValue('E' . $count, $row['nohp']);
            $sheet->setCellValue('F' . $count, $row['alamat']);
            $sheet->setCellValue('G' . $count, $row['kecamatan_kode']);
            $sheet->setCellValue('H' . $count, $row['desa_kode']);
            $sheet->setCellValue('I' . $count, $row['alamat_sesuai']);
            $sheet->setCellValue('J' . $count, $row['date_birth']);
            $sheet->setCellValue('K' . $count, $row['jenis_kelamin']);
            $sheet->setCellValue('L' . $count, $row['agama']);
            $sheet->setCellValue('M' . $count, $row['status']);
            $sheet->setCellValue('N' . $count, $row['pendidikan']);
            $sheet->setCellValue('O' . $count, $row['pekerjaan']);
            $sheet->setCellValue('P' . $count, $row['pengalaman']);
            $sheet->setCellValue('Q' . $count, $row['penempatan']);
            $sheet->setCellValue('R' . $count, $row['penempatan2']);
            $sheet->setCellValue('S' . $count, $row['perkenalan']);

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $sheet->getStyle('A' . $count)->applyFromArray($style_row);
            $sheet->getStyle('B' . $count)->applyFromArray($style_row);
            $sheet->getStyle('C' . $count)->applyFromArray($style_row);
            $sheet->getStyle('D' . $count)->applyFromArray($style_row);
            $sheet->getStyle('E' . $count)->applyFromArray($style_row);
            $sheet->getStyle('F' . $count)->applyFromArray($style_row);
            $sheet->getStyle('G' . $count)->applyFromArray($style_row);
            $sheet->getStyle('H' . $count)->applyFromArray($style_row);
            $sheet->getStyle('I' . $count)->applyFromArray($style_row);
            $sheet->getStyle('J' . $count)->applyFromArray($style_row);
            $sheet->getStyle('K' . $count)->applyFromArray($style_row);
            $sheet->getStyle('L' . $count)->applyFromArray($style_row);
            $sheet->getStyle('M' . $count)->applyFromArray($style_row);
            $sheet->getStyle('N' . $count)->applyFromArray($style_row);
            $sheet->getStyle('O' . $count)->applyFromArray($style_row);
            $sheet->getStyle('P' . $count)->applyFromArray($style_row);
            $sheet->getStyle('Q' . $count)->applyFromArray($style_row);
            $sheet->getStyle('R' . $count)->applyFromArray($style_row);
            $sheet->getStyle('S' . $count)->applyFromArray($style_row);
            $count++;
        }
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->getColumnDimension('J')->setAutoSize(true);
        $sheet->getColumnDimension('K')->setAutoSize(true);
        $sheet->getColumnDimension('L')->setAutoSize(true);
        $sheet->getColumnDimension('M')->setAutoSize(true);
        $sheet->getColumnDimension('N')->setAutoSize(true);
        $sheet->getColumnDimension('O')->setAutoSize(true);
        $sheet->getColumnDimension('P')->setAutoSize(true);
        $sheet->getColumnDimension('Q')->setAutoSize(true);
        $sheet->getColumnDimension('R')->setAutoSize(true);
        $sheet->getColumnDimension('S')->setAutoSize(true);

        $writer = new Xlsx($spreadsheet);
        $writer->save($file_name);

        header("Content-Type: application/vnd.ms-excel");
        header('Content-Disposition: attachment; filename="' . basename($file_name) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length:' . filesize($file_name));

        flush();
        readfile($file_name);
        exit;
    }
}
