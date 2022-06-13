<?php

namespace App\Controllers;

use Config\Services;

class Akademik extends BaseController
{
    public function index()
    {
        //Get All Data Peserta
        $user_id     = session()->get('user_id');
        $get_peserta = $this->peserta->get_peserta($user_id);

        //Get data peserta id
        $get_peserta_id = $this->peserta->get_peserta_id($user_id);
        $peserta_id     = $get_peserta_id->peserta_id;

        //Get kelas peserta 
        $kelas_peserta      = $this->peserta_kelas->kelas_peserta($peserta_id);
        // $kelas_peserta_lulus= $this->peserta_kelas->kelas_peserta_lulus($peserta_id);

        $data = [
            'title'         => 'Al-Haqq - Akademik Peserta',
            'kelas'         => $kelas_peserta,
            // 'kelas_lulus'   => $kelas_peserta_lulus,
        ];

        return view('auth/akademik/index', $data); 
    }

    public function admin_rekap_absen_peserta()
    {
        $uri                = service('uri');
        $get_angkatan_url   = $uri->getSegment(4);
        if ($get_angkatan_url == NULL) {
            $get_angkatan       = $this->konfigurasi->angkatan_kuliah();
            //Angkatan perkuliahan
            $angkatan           = $get_angkatan->angkatan_kuliah;
        } elseif ($get_angkatan_url != NULL) {
            $angkatan = $get_angkatan_url;
        }
        
        $list_angkatan      = $this->program->list_unik_angkatan();
        $list_absensi       = $this->peserta_kelas->admin_rekap_absen_peserta($angkatan);

        $data = [
            'title'         => 'Al-Haqq - Data Absensi Peserta pada Angkatan Perkuliahan ' . $angkatan,
            'list'          => $list_absensi,
            'list_angkatan' => $list_angkatan,
            'angkatan_pilih'=> $angkatan,
        ];
        return view('auth/akademik/rekap_absen_peserta', $data);
    }

    public function rekap_absen_peserta_export()
    {
        $uri                = service('uri');
        $get_angkatan_url   = $uri->getSegment(3);
        if ($get_angkatan_url == NULL) {
            $get_angkatan       = $this->konfigurasi->angkatan_kuliah();
            //Angkatan perkuliahan
            $angkatan           = $get_angkatan->angkatan_kuliah;
        } elseif ($get_angkatan_url != NULL) {
            $angkatan = $get_angkatan_url;
        }

        $absen_peserta = $this->peserta_kelas->admin_rekap_absen_peserta($angkatan);
        $judul = "DATA REKAP ABSEN PESERTA ANGKATAN PERKULIAHAN " . $angkatan;
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $styleColumn = [
            'font' => [
                'bold' => true,
                'size' => 14,
            ],
            'alignment' => [
                'horizontal'    => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical'      => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ]
        ];

        $border = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $sheet->setCellValue('A1', $judul);
        $sheet->mergeCells('A1:V1');
        $sheet->getStyle('A1')->applyFromArray($styleColumn);

        $sheet->setCellValue('A2', date("Y-m-d"));
        $sheet->mergeCells('A2:V2');
        $sheet->getStyle('A2')->applyFromArray($styleColumn);

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A4', 'NIS')
            ->setCellValue('B4', 'NAMA')
            ->setCellValue('C4', 'KELAS')
            ->setCellValue('D4', 'ANGKATAN KULIAH')
            ->setCellValue('E4', 'STATUS PESERTA')
            ->setCellValue('F4', 'TM1')
            ->setCellValue('G4', 'TM2')
            ->setCellValue('H4', 'TM3')
            ->setCellValue('I4', 'TM4')
            ->setCellValue('J4', 'TM5')
            ->setCellValue('K4', 'TM6')
            ->setCellValue('L4', 'TM7')
            ->setCellValue('M4', 'TM8')
            ->setCellValue('N4', 'TM9')
            ->setCellValue('O4', 'TM10')
            ->setCellValue('P4', 'TM11')
            ->setCellValue('Q4', 'TM12')
            ->setCellValue('R4', 'TM13')
            ->setCellValue('S4', 'TM14')
            ->setCellValue('T4', 'TM15')
            ->setCellValue('U4', 'TM16')
            ->setCellValue('V4', 'TOTAL HADIR');
        
        $sheet->getStyle('A4')->applyFromArray($border);
        $sheet->getStyle('B4')->applyFromArray($border);
        $sheet->getStyle('C4')->applyFromArray($border);
        $sheet->getStyle('D4')->applyFromArray($border);
        $sheet->getStyle('E4')->applyFromArray($border);
        $sheet->getStyle('F4')->applyFromArray($border);
        $sheet->getStyle('G4')->applyFromArray($border);
        $sheet->getStyle('H4')->applyFromArray($border);
        $sheet->getStyle('I4')->applyFromArray($border);
        $sheet->getStyle('J4')->applyFromArray($border);
        $sheet->getStyle('K4')->applyFromArray($border);
        $sheet->getStyle('L4')->applyFromArray($border);
        $sheet->getStyle('M4')->applyFromArray($border);
        $sheet->getStyle('N4')->applyFromArray($border);
        $sheet->getStyle('O4')->applyFromArray($border);
        $sheet->getStyle('P4')->applyFromArray($border);
        $sheet->getStyle('Q4')->applyFromArray($border);
        $sheet->getStyle('R4')->applyFromArray($border);
        $sheet->getStyle('S4')->applyFromArray($border);
        $sheet->getStyle('T4')->applyFromArray($border);
        $sheet->getStyle('U4')->applyFromArray($border);
        $sheet->getStyle('V4')->applyFromArray($border);
        

        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);

        $row = 5;

        foreach ($absen_peserta as $absen) {
            $total = $absen['tm1'] + $absen['tm2'] + $absen['tm3'] + $absen['tm4'] + $absen['tm5'] + $absen['tm6'] + $absen['tm7'] + $absen['tm8'] + $absen['tm9'] + $absen['tm10'] + $absen['tm11'] + $absen['tm12'] + $absen['tm13'] + $absen['tm14'] + $absen['tm15'] + $absen['tm16'];
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $row, $absen['nis'])
                ->setCellValue('B' . $row, $absen['nama_peserta'])
                ->setCellValue('C' . $row, $absen['nama_kelas'])
                ->setCellValue('D' . $row, $absen['angkatan_kelas'])
                ->setCellValue('E' . $row, $absen['status_peserta'])
                ->setCellValue('F' . $row, $absen['tm1'])
                ->setCellValue('G' . $row, $absen['tm2'])
                ->setCellValue('H' . $row, $absen['tm3'])
                ->setCellValue('I' . $row, $absen['tm4'])
                ->setCellValue('J' . $row, $absen['tm5'])
                ->setCellValue('K' . $row, $absen['tm6'])
                ->setCellValue('L' . $row, $absen['tm7'])
                ->setCellValue('M' . $row, $absen['tm8'])
                ->setCellValue('N' . $row, $absen['tm9'])
                ->setCellValue('O' . $row, $absen['tm10'])
                ->setCellValue('P' . $row, $absen['tm11'])
                ->setCellValue('Q' . $row, $absen['tm12'])
                ->setCellValue('R' . $row, $absen['tm13'])
                ->setCellValue('S' . $row, $absen['tm14'])
                ->setCellValue('T' . $row, $absen['tm15'])
                ->setCellValue('U' . $row, $absen['tm16'])
                ->setCellValue('V' . $row, $total);

            $sheet->getStyle('A' . $row)->applyFromArray($border);
            $sheet->getStyle('B' . $row)->applyFromArray($border);
            $sheet->getStyle('C' . $row)->applyFromArray($border);
            $sheet->getStyle('D' . $row)->applyFromArray($border);
            $sheet->getStyle('E' . $row)->applyFromArray($border);
            $sheet->getStyle('F' . $row)->applyFromArray($border);
            $sheet->getStyle('G' . $row)->applyFromArray($border);
            $sheet->getStyle('H' . $row)->applyFromArray($border);
            $sheet->getStyle('I' . $row)->applyFromArray($border);
            $sheet->getStyle('J' . $row)->applyFromArray($border);
            $sheet->getStyle('K' . $row)->applyFromArray($border);
            $sheet->getStyle('L' . $row)->applyFromArray($border);
            $sheet->getStyle('M' . $row)->applyFromArray($border);
            $sheet->getStyle('N' . $row)->applyFromArray($border);
            $sheet->getStyle('O' . $row)->applyFromArray($border);
            $sheet->getStyle('P' . $row)->applyFromArray($border);
            $sheet->getStyle('Q' . $row)->applyFromArray($border);
            $sheet->getStyle('R' . $row)->applyFromArray($border);
            $sheet->getStyle('S' . $row)->applyFromArray($border);
            $sheet->getStyle('T' . $row)->applyFromArray($border);
            $sheet->getStyle('U' . $row)->applyFromArray($border);
            $sheet->getStyle('V' . $row)->applyFromArray($border);

            $row++;
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename =  'Data-Rekap-Absen-Peserta-'. date('Y-m-d-His');

        // Data Log START
        $log = [
            'username_log' => session()->get('username'),
            'tgl_log'      => date("Y-m-d"),
            'waktu_log'    => date("H:i:s"),
            'status_log'   => 'BERHASIL',
            'aktivitas_log'=> 'Download Data Rekap Absen Peserta via Export Excel, Waktu : ' .  date('Y-m-d-H:i:s'),
        ];
        $this->log->insert($log);
        // Data Log END

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function admin_rekap_absen_pengajar()
    {
        $uri                = service('uri');
        $get_angkatan_url   = $uri->getSegment(4);
        if ($get_angkatan_url == NULL) {
            $get_angkatan       = $this->konfigurasi->angkatan_kuliah();
            //Angkatan perkuliahan
            $angkatan           = $get_angkatan->angkatan_kuliah;
        } elseif ($get_angkatan_url != NULL) {
            $angkatan = $get_angkatan_url;
        }
        
        $list_angkatan      = $this->program->list_unik_angkatan();
        $list_absensi       = $this->program->admin_rekap_absen_pengajar($angkatan);
        
        $data = [
            'title'         => 'Al-Haqq - Data Absensi Pengajar pada Angkatan Perkuliahan ' . $angkatan,
            'list'          => $list_absensi,
            'list_angkatan' => $list_angkatan,
            'angkatan_pilih'=> $angkatan,
        ];
        return view('auth/akademik/rekap_absen_pengajar', $data);
    }

    public function catatan_absen_pengajar()
    {
        if ($this->request->isAJAX()) {

            $absen_pengajar_id  = $this->request->getVar('absen_pengajar_id');
            $kelas_id           = $this->request->getVar('kelas_id');
            $data_kelas         = $this->program->find($kelas_id);
            $pengajar_id        = $data_kelas['pengajar_id'];
            $data_pengajar      = $this->pengajar->find($pengajar_id);
            $nama_pengajar      = $data_pengajar['nama_pengajar'];
            $nama_kelas         = $data_kelas['nama_kelas'];
             // Get data absen pengajar
            $absen_pengajar         = $this->absen_pengajar->find($absen_pengajar_id);

            $data = [
                'title'   => 'Catatan Absen Pengajar Kelas ' . $nama_kelas ,
                'pengajar' => $nama_pengajar,
                'note_tm1'               => $absen_pengajar ['note_tm1'],
                'note_tm2'               => $absen_pengajar ['note_tm2'],
                'note_tm3'               => $absen_pengajar ['note_tm3'],
                'note_tm4'               => $absen_pengajar ['note_tm4'],
                'note_tm5'               => $absen_pengajar ['note_tm5'],
                'note_tm6'               => $absen_pengajar ['note_tm6'],
                'note_tm7'               => $absen_pengajar ['note_tm7'],
                'note_tm8'               => $absen_pengajar ['note_tm8'],
                'note_tm9'               => $absen_pengajar ['note_tm9'],
                'note_tm10'              => $absen_pengajar ['note_tm10'],
                'note_tm11'              => $absen_pengajar ['note_tm11'],
                'note_tm12'              => $absen_pengajar ['note_tm12'],
                'note_tm13'              => $absen_pengajar ['note_tm13'],
                'note_tm14'              => $absen_pengajar ['note_tm14'],
                'note_tm15'              => $absen_pengajar ['note_tm15'],
                'note_tm16'              => $absen_pengajar ['note_tm16'],

                'tgl_tm1'               => $absen_pengajar ['tgl_tm1'],
                'tgl_tm2'               => $absen_pengajar ['tgl_tm2'],
                'tgl_tm3'               => $absen_pengajar ['tgl_tm3'],
                'tgl_tm4'               => $absen_pengajar ['tgl_tm4'],
                'tgl_tm5'               => $absen_pengajar ['tgl_tm5'],
                'tgl_tm6'               => $absen_pengajar ['tgl_tm6'],
                'tgl_tm7'               => $absen_pengajar ['tgl_tm7'],
                'tgl_tm8'               => $absen_pengajar ['tgl_tm8'],
                'tgl_tm9'               => $absen_pengajar ['tgl_tm9'],
                'tgl_tm10'              => $absen_pengajar ['tgl_tm10'],
                'tgl_tm11'              => $absen_pengajar ['tgl_tm11'],
                'tgl_tm12'              => $absen_pengajar ['tgl_tm12'],
                'tgl_tm13'              => $absen_pengajar ['tgl_tm13'],
                'tgl_tm14'              => $absen_pengajar ['tgl_tm14'],
                'tgl_tm15'              => $absen_pengajar ['tgl_tm15'],
                'tgl_tm16'              => $absen_pengajar ['tgl_tm16'],

            ];
            $msg = [
                'sukses' => view('auth/akademik/catatan_absen_pengajar', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function rekap_absen_pengajar_export()
    {
        $uri                = service('uri');
        $get_angkatan_url   = $uri->getSegment(3);
        if ($get_angkatan_url == NULL) {
            $get_angkatan       = $this->konfigurasi->angkatan_kuliah();
            //Angkatan perkuliahan
            $angkatan           = $get_angkatan->angkatan_kuliah;
        } elseif ($get_angkatan_url != NULL) {
            $angkatan = $get_angkatan_url;
        }

        $absen_pengajar =  $this->program->admin_rekap_absen_pengajar($angkatan);
        $judul = "DATA REKAP ABSEN PENGAJAR ANGKATAN PERKULIAHAN " . $angkatan;
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $styleColumn = [
            'font' => [
                'bold' => true,
                'size' => 14,
            ],
            'alignment' => [
                'horizontal'    => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical'      => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ]
        ];

        $border = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $sheet->setCellValue('A1', $judul);
        $sheet->mergeCells('A1:BC1');
        $sheet->getStyle('A1')->applyFromArray($styleColumn);

        $sheet->setCellValue('A2', date("Y-m-d"));
        $sheet->mergeCells('A2:BC2');
        $sheet->getStyle('A2')->applyFromArray($styleColumn);

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A4', 'ID PENGAJAR')
            ->setCellValue('B4', 'NAMA PENGAJAR')
            ->setCellValue('C4', 'CABANG')
            ->setCellValue('D4', 'KELAS')
            ->setCellValue('E4', 'ANGKATAN PERKULIAHAN')
            ->setCellValue('F4', 'TM1')
            ->setCellValue('G4', 'TM2')
            ->setCellValue('H4', 'TM3')
            ->setCellValue('I4', 'TM4')
            ->setCellValue('J4', 'TM5')
            ->setCellValue('K4', 'TM6')
            ->setCellValue('L4', 'TM7')
            ->setCellValue('M4', 'TM8')
            ->setCellValue('N4', 'TM9')
            ->setCellValue('O4', 'TM10')
            ->setCellValue('P4', 'TM11')
            ->setCellValue('Q4', 'TM12')
            ->setCellValue('R4', 'TM13')
            ->setCellValue('S4', 'TM14')
            ->setCellValue('T4', 'TM15')
            ->setCellValue('U4', 'TM16')
            ->setCellValue('V4', 'TOTAL HADIR')

            ->setCellValue('X4', 'TGL TM1')
            ->setCellValue('Y4', 'NOTE TM1')
            ->setCellValue('Z4', 'TGL TM2')
            ->setCellValue('AA4', 'NOTE TM2')
            ->setCellValue('AB4', 'TGL TM3')
            ->setCellValue('AC4', 'NOTE TM3')
            ->setCellValue('AD4', 'TGL TM4')
            ->setCellValue('AE4', 'NOTE TM4')
            ->setCellValue('AF4', 'TGL TM5')
            ->setCellValue('AG4', 'NOTE TM5')
            ->setCellValue('AH4', 'TGL TM6')
            ->setCellValue('AI4', 'NOTE TM6')
            ->setCellValue('AJ4', 'TGL TM7')
            ->setCellValue('AK4', 'NOTE TM7')
            ->setCellValue('AL4', 'TGL TM8')
            ->setCellValue('AM4', 'NOTE TM8')

            ->setCellValue('AN4', 'TGL TM9')
            ->setCellValue('AO4', 'NOTE TM9')
            ->setCellValue('AP4', 'TGL TM10')
            ->setCellValue('AQ4', 'NOTE TM10')
            ->setCellValue('AR4', 'TGL TM11')
            ->setCellValue('AS4', 'NOTE TM11')
            ->setCellValue('AT4', 'TGL TM12')
            ->setCellValue('AU4', 'NOTE TM12')
            ->setCellValue('AV4', 'TGL TM13')
            ->setCellValue('AW4', 'NOTE TM13')
            ->setCellValue('AX4', 'TGL TM14')
            ->setCellValue('AY4', 'NOTE TM14')
            ->setCellValue('BZ4', 'TGL TM15')
            ->setCellValue('BA4', 'NOTE TM15')
            ->setCellValue('BB4', 'TGL TM16')
            ->setCellValue('BC4', 'NOTE TM16');
        
        $sheet->getStyle('A4')->applyFromArray($border);
        $sheet->getStyle('B4')->applyFromArray($border);
        $sheet->getStyle('C4')->applyFromArray($border);
        $sheet->getStyle('D4')->applyFromArray($border);
        $sheet->getStyle('E4')->applyFromArray($border);
        $sheet->getStyle('F4')->applyFromArray($border);
        $sheet->getStyle('G4')->applyFromArray($border);
        $sheet->getStyle('H4')->applyFromArray($border);
        $sheet->getStyle('I4')->applyFromArray($border);
        $sheet->getStyle('J4')->applyFromArray($border);
        $sheet->getStyle('K4')->applyFromArray($border);
        $sheet->getStyle('L4')->applyFromArray($border);
        $sheet->getStyle('M4')->applyFromArray($border);
        $sheet->getStyle('N4')->applyFromArray($border);
        $sheet->getStyle('O4')->applyFromArray($border);
        $sheet->getStyle('P4')->applyFromArray($border);
        $sheet->getStyle('Q4')->applyFromArray($border);
        $sheet->getStyle('R4')->applyFromArray($border);
        $sheet->getStyle('S4')->applyFromArray($border);
        $sheet->getStyle('T4')->applyFromArray($border);
        $sheet->getStyle('U4')->applyFromArray($border);
        $sheet->getStyle('V4')->applyFromArray($border);

        $sheet->getStyle('X4')->applyFromArray($border);
        $sheet->getStyle('Y4')->applyFromArray($border);
        $sheet->getStyle('Z4')->applyFromArray($border);
        $sheet->getStyle('AA4')->applyFromArray($border);
        $sheet->getStyle('AB4')->applyFromArray($border);
        $sheet->getStyle('AC4')->applyFromArray($border);
        $sheet->getStyle('AD4')->applyFromArray($border);
        $sheet->getStyle('AE4')->applyFromArray($border);
        $sheet->getStyle('AF4')->applyFromArray($border);
        $sheet->getStyle('AG4')->applyFromArray($border);
        $sheet->getStyle('AH4')->applyFromArray($border);
        $sheet->getStyle('AI4')->applyFromArray($border);
        $sheet->getStyle('AJ4')->applyFromArray($border);
        $sheet->getStyle('AK4')->applyFromArray($border);
        $sheet->getStyle('AL4')->applyFromArray($border);
        $sheet->getStyle('AM4')->applyFromArray($border);

        $sheet->getStyle('AN4')->applyFromArray($border);
        $sheet->getStyle('AO4')->applyFromArray($border);
        $sheet->getStyle('AP4')->applyFromArray($border);
        $sheet->getStyle('AQ4')->applyFromArray($border);
        $sheet->getStyle('AR4')->applyFromArray($border);
        $sheet->getStyle('AS4')->applyFromArray($border);
        $sheet->getStyle('AT4')->applyFromArray($border);
        $sheet->getStyle('AU4')->applyFromArray($border);
        $sheet->getStyle('AV4')->applyFromArray($border);
        $sheet->getStyle('AW4')->applyFromArray($border);
        $sheet->getStyle('AX4')->applyFromArray($border);
        $sheet->getStyle('AY4')->applyFromArray($border);
        $sheet->getStyle('AZ4')->applyFromArray($border);
        $sheet->getStyle('BA4')->applyFromArray($border);
        $sheet->getStyle('BB4')->applyFromArray($border);
        $sheet->getStyle('BC4')->applyFromArray($border);
        

        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);

        $row = 5;

        foreach ($absen_pengajar as $absen) {
            $total = $absen['tm1_pengajar'] + $absen['tm2_pengajar'] + $absen['tm3_pengajar'] + $absen['tm4_pengajar'] + $absen['tm5_pengajar'] + $absen['tm6_pengajar'] + $absen['tm7_pengajar'] + $absen['tm8_pengajar'] + $absen['tm9_pengajar'] + $absen['tm10_pengajar'] + $absen['tm11_pengajar'] + $absen['tm12_pengajar'] + $absen['tm13_pengajar'] + $absen['tm14_pengajar'] + $absen['tm15_pengajar'] + $absen['tm16_pengajar'];

            if ($absen['tm1_pengajar'] == '1000-01-01') {
                $tm1_pengajar = '';
            } else {
                $tm1_pengajar = $absen['tm1_pengajar'];
            };
            if ($absen['tm2_pengajar'] == '1000-01-01') {
                $tm2_pengajar = '';
            }else {
                $tm2_pengajar = $absen['tm2_pengajar'];
            };
            if ($absen['tm3_pengajar'] == '1000-01-01') {
                $tm3_pengajar = '';
            }else {
                $tm3_pengajar = $absen['tm3_pengajar'];
            };
            if ($absen['tm4_pengajar'] == '1000-01-01') {
                $tm4_pengajar = '';
            }else {
                $tm4_pengajar = $absen['tm4_pengajar'];
            };
            if ($absen['tm5_pengajar'] == '1000-01-01') {
                $tm5_pengajar = '';
            }else {
                $tm5_pengajar = $absen['tm5_pengajar'];
            };
            if ($absen['tm6_pengajar'] == '1000-01-01') {
                $tm6_pengajar = '';
            }else {
                $tm6_pengajar = $absen['tm6_pengajar'];
            };
            if ($absen['tm7_pengajar'] == '1000-01-01') {
                $tm7_pengajar = '';
            }else {
                $tm7_pengajar = $absen['tm7_pengajar'];
            };
            if ($absen['tm8_pengajar'] == '1000-01-01') {
                $tm8_pengajar = '';
            }else {
                $tm8_pengajar = $absen['tm8_pengajar'];
            };
            if ($absen['tm9_pengajar'] == '1000-01-01') {
                $tm9_pengajar = '';
            }else {
                $tm9_pengajar = $absen['tm9_pengajar'];
            };
            if ($absen['tm10_pengajar'] == '1000-01-01') {
                $tm10_pengajar = '';
            }else {
                $tm10_pengajar = $absen['tm10_pengajar'];
            };
            if ($absen['tm11_pengajar'] == '1000-01-01') {
                $tm11_pengajar = '';
            }else {
                $tm11_pengajar = $absen['tm11_pengajar'];
            };
            if ($absen['tm12_pengajar'] == '1000-01-01') {
                $tm12_pengajar = '';
            }else {
                $tm12_pengajar = $absen['tm12_pengajar'];
            };
            if ($absen['tm13_pengajar'] == '1000-01-01') {
                $tm13_pengajar = '';
            }else {
                $tm13_pengajar = $absen['tm13_pengajar'];
            };
            if ($absen['tm14_pengajar'] == '1000-01-01') {
                $tm14_pengajar = '';
            }else {
                $tm14_pengajar = $absen['tm14_pengajar'];
            };
            if ($absen['tm15_pengajar'] == '1000-01-01') {
                $tm15_pengajar = '';
            }else {
                $tm15_pengajar = $absen['tm15_pengajar'];
            };
            if ($absen['tm16_pengajar'] == '1000-01-01') {
                $tm16_pengajar = '';
            }else {
                $tm16_pengajar = $absen['tm16_pengajar'];
            };

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $row, $absen['pengajar_id'])
                ->setCellValue('B' . $row, $absen['nama_pengajar'])
                ->setCellValue('C' . $row, $absen['nama_kantor'])
                ->setCellValue('D' . $row, $absen['nama_kelas'])
                ->setCellValue('E' . $row, $absen['angkatan_kelas'])
                ->setCellValue('F' . $row, $absen['tm1_pengajar'])
                ->setCellValue('G' . $row, $absen['tm2_pengajar'])
                ->setCellValue('H' . $row, $absen['tm3_pengajar'])
                ->setCellValue('I' . $row, $absen['tm4_pengajar'])
                ->setCellValue('J' . $row, $absen['tm5_pengajar'])
                ->setCellValue('K' . $row, $absen['tm6_pengajar'])
                ->setCellValue('L' . $row, $absen['tm7_pengajar'])
                ->setCellValue('M' . $row, $absen['tm8_pengajar'])
                ->setCellValue('N' . $row, $absen['tm9_pengajar'])
                ->setCellValue('O' . $row, $absen['tm10_pengajar'])
                ->setCellValue('P' . $row, $absen['tm11_pengajar'])
                ->setCellValue('Q' . $row, $absen['tm12_pengajar'])
                ->setCellValue('R' . $row, $absen['tm13_pengajar'])
                ->setCellValue('S' . $row, $absen['tm14_pengajar'])
                ->setCellValue('T' . $row, $absen['tm15_pengajar'])
                ->setCellValue('U' . $row, $absen['tm16_pengajar'])
                ->setCellValue('V' . $row, $total)

                ->setCellValue('X' . $row, $tgl_tm1)
                ->setCellValue('Y' . $row, $absen['note_tm1'])
                ->setCellValue('Z' . $row, $tgl_tm2)
                ->setCellValue('AA' . $row, $absen['note_tm2'])
                ->setCellValue('AB' . $row, $tgl_tm3)
                ->setCellValue('AC' . $row, $absen['note_tm3'])
                ->setCellValue('AD' . $row, $tgl_tm4)
                ->setCellValue('AE' . $row, $absen['note_tm4'])
                ->setCellValue('AF' . $row, $tgl_tm5)
                ->setCellValue('AG' . $row, $absen['note_tm5'])
                ->setCellValue('AH' . $row, $tgl_tm6)
                ->setCellValue('AI' . $row, $absen['note_tm6'])
                ->setCellValue('AJ' . $row, $tgl_tm7)
                ->setCellValue('AK' . $row, $absen['note_tm7'])
                ->setCellValue('AL' . $row, $tgl_tm8)
                ->setCellValue('AM' . $row, $absen['note_tm8'])

                ->setCellValue('AN' . $row, $tgl_tm9)
                ->setCellValue('AO' . $row, $absen['note_tm9'])
                ->setCellValue('AP' . $row, $tgl_tm10)
                ->setCellValue('AQ' . $row, $absen['note_m10'])
                ->setCellValue('AR' . $row, $tgl_tm11)
                ->setCellValue('AS' . $row, $absen['note_m11'])
                ->setCellValue('AT' . $row, $tgl_tm12)
                ->setCellValue('AU' . $row, $absen['note_m12'])
                ->setCellValue('AV' . $row, $tgl_tm13)
                ->setCellValue('AW' . $row, $absen['note_m13'])
                ->setCellValue('AX' . $row, $tgl_tm14)
                ->setCellValue('AY' . $row, $absen['note_m14'])
                ->setCellValue('AZ' . $row, $tgl_tm15)
                ->setCellValue('BA' . $row, $absen['note_m15'])
                ->setCellValue('BB' . $row, $tgl_tm16)
                ->setCellValue('BC' . $row, $absen['note_m16']);

            $sheet->getStyle('A' . $row)->applyFromArray($border);
            $sheet->getStyle('B' . $row)->applyFromArray($border);
            $sheet->getStyle('C' . $row)->applyFromArray($border);
            $sheet->getStyle('D' . $row)->applyFromArray($border);
            $sheet->getStyle('E' . $row)->applyFromArray($border);
            $sheet->getStyle('F' . $row)->applyFromArray($border);
            $sheet->getStyle('G' . $row)->applyFromArray($border);
            $sheet->getStyle('H' . $row)->applyFromArray($border);
            $sheet->getStyle('I' . $row)->applyFromArray($border);
            $sheet->getStyle('J' . $row)->applyFromArray($border);
            $sheet->getStyle('K' . $row)->applyFromArray($border);
            $sheet->getStyle('L' . $row)->applyFromArray($border);
            $sheet->getStyle('M' . $row)->applyFromArray($border);
            $sheet->getStyle('N' . $row)->applyFromArray($border);
            $sheet->getStyle('O' . $row)->applyFromArray($border);
            $sheet->getStyle('P' . $row)->applyFromArray($border);
            $sheet->getStyle('Q' . $row)->applyFromArray($border);
            $sheet->getStyle('R' . $row)->applyFromArray($border);
            $sheet->getStyle('S' . $row)->applyFromArray($border);
            $sheet->getStyle('T' . $row)->applyFromArray($border);
            $sheet->getStyle('U' . $row)->applyFromArray($border);
            $sheet->getStyle('V' . $row)->applyFromArray($border);

            $sheet->getStyle('X' . $row)->applyFromArray($border);
            $sheet->getStyle('Y' . $row)->applyFromArray($border);
            $sheet->getStyle('Z' . $row)->applyFromArray($border);
            $sheet->getStyle('AA' . $row)->applyFromArray($border);
            $sheet->getStyle('AB' . $row)->applyFromArray($border);
            $sheet->getStyle('AC' . $row)->applyFromArray($border);
            $sheet->getStyle('AD' . $row)->applyFromArray($border);
            $sheet->getStyle('AE' . $row)->applyFromArray($border);
            $sheet->getStyle('AF' . $row)->applyFromArray($border);
            $sheet->getStyle('AG' . $row)->applyFromArray($border);
            $sheet->getStyle('AH' . $row)->applyFromArray($border);
            $sheet->getStyle('AI' . $row)->applyFromArray($border);
            $sheet->getStyle('AJ' . $row)->applyFromArray($border);
            $sheet->getStyle('AK' . $row)->applyFromArray($border);
            $sheet->getStyle('AL' . $row)->applyFromArray($border);
            $sheet->getStyle('AM' . $row)->applyFromArray($border);

             $sheet->getStyle('AN' . $row)->applyFromArray($border);
             $sheet->getStyle('AO' . $row)->applyFromArray($border);
             $sheet->getStyle('AP' . $row)->applyFromArray($border);
             $sheet->getStyle('AQ' . $row)->applyFromArray($border);
             $sheet->getStyle('AR' . $row)->applyFromArray($border);
             $sheet->getStyle('AS' . $row)->applyFromArray($border);
             $sheet->getStyle('AT' . $row)->applyFromArray($border);
             $sheet->getStyle('AU' . $row)->applyFromArray($border);
             $sheet->getStyle('AV' . $row)->applyFromArray($border);
             $sheet->getStyle('AW' . $row)->applyFromArray($border);
             $sheet->getStyle('AX' . $row)->applyFromArray($border);
             $sheet->getStyle('AY' . $row)->applyFromArray($border);
             $sheet->getStyle('AZ' . $row)->applyFromArray($border);
             $sheet->getStyle('BA' . $row)->applyFromArray($border);
             $sheet->getStyle('BB' . $row)->applyFromArray($border);
             $sheet->getStyle('BC' . $row)->applyFromArray($border);

            $row++;
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename =  'Data-Rekap-Absen-Pengajar-'. date('Y-m-d-His');

        // Data Log START
        $log = [
            'username_log' => session()->get('username'),
            'tgl_log'      => date("Y-m-d"),
            'waktu_log'    => date("H:i:s"),
            'status_log'   => 'BERHASIL',
            'aktivitas_log'=> 'Download Data Rekap Absen Pengajar via Export Excel, Waktu : ' .  date('Y-m-d-H:i:s'),
        ];
        $this->log->insert($log);
        // Data Log END

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function admin_rekap_ujian()
    {
        $uri                = service('uri');
        $get_angkatan_url   = $uri->getSegment(4);
        if ($get_angkatan_url == NULL) {
            $get_angkatan       = $this->konfigurasi->angkatan_kuliah();
            //Angkatan perkuliahan
            $angkatan           = $get_angkatan->angkatan_kuliah;
        } elseif ($get_angkatan_url != NULL) {
            $angkatan = $get_angkatan_url;
        }
        
        $list_angkatan      = $this->program->list_unik_angkatan();
        $list_ujian         = $this->peserta_kelas->admin_rekap_ujian($angkatan);

        $data = [
            'title'         => 'Al-Haqq - Data Ujian Peserta pada Angkatan Perkuliahan ' . $angkatan,
            'list'          => $list_ujian,
            'list_angkatan' => $list_angkatan,
            'angkatan_pilih'=> $angkatan,
        ];
        return view('auth/akademik/rekap_ujian_peserta', $data);
    }

    public function rekap_ujian_peserta_export()
    {
        $uri                = service('uri');
        $get_angkatan_url   = $uri->getSegment(3);
        if ($get_angkatan_url == NULL) {
            $get_angkatan       = $this->konfigurasi->angkatan_kuliah();
            //Angkatan perkuliahan
            $angkatan           = $get_angkatan->angkatan_kuliah;
        } elseif ($get_angkatan_url != NULL) {
            $angkatan = $get_angkatan_url;
        }

        $ujian = $this->peserta_kelas->admin_rekap_ujian($angkatan);
        $judul = "DATA REKAP HASIL UJIAN PESERTA ANGKATAN PERKULIAHAN " . $angkatan;
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $styleColumn = [
            'font' => [
                'bold' => true,
                'size' => 14,
            ],
            'alignment' => [
                'horizontal'    => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical'      => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ]
        ];

        $border = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $sheet->setCellValue('A1', $judul);
        $sheet->mergeCells('A1:V1');
        $sheet->getStyle('A1')->applyFromArray($styleColumn);

        $sheet->setCellValue('A2', date("Y-m-d"));
        $sheet->mergeCells('A2:V2');
        $sheet->getStyle('A2')->applyFromArray($styleColumn);

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A4', 'ID UJIAN')
            ->setCellValue('B4', 'NIS')
            ->setCellValue('C4', 'NAMA')
            ->setCellValue('D4', 'JENIS KELAMIN')
            ->setCellValue('E4', 'KELAS')
            ->setCellValue('F4', 'ANGKATAN PERKULIAHAN')
            ->setCellValue('G4', 'PENGAJAR')
            ->setCellValue('H4', 'HARI KELAS')
            ->setCellValue('I4', 'WAKTU KELAS')
            ->setCellValue('J4', 'TGL UJIAN')
            ->setCellValue('K4', 'WAKTU UJIAN')
            ->setCellValue('L4', 'NILAI UJIAN')
            ->setCellValue('M4', 'NILAI AKHIR')
            ->setCellValue('N4', 'KELULUSAN');
        
        $sheet->getStyle('A4')->applyFromArray($border);
        $sheet->getStyle('B4')->applyFromArray($border);
        $sheet->getStyle('C4')->applyFromArray($border);
        $sheet->getStyle('D4')->applyFromArray($border);
        $sheet->getStyle('E4')->applyFromArray($border);
        $sheet->getStyle('F4')->applyFromArray($border);
        $sheet->getStyle('G4')->applyFromArray($border);
        $sheet->getStyle('H4')->applyFromArray($border);
        $sheet->getStyle('I4')->applyFromArray($border);
        $sheet->getStyle('J4')->applyFromArray($border);
        $sheet->getStyle('K4')->applyFromArray($border);
        $sheet->getStyle('L4')->applyFromArray($border);
        $sheet->getStyle('M4')->applyFromArray($border);
        $sheet->getStyle('N4')->applyFromArray($border);
        

        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);

        $row = 5;

        foreach ($ujian as $data) {

                $waktu = $data['waktu_kelas'] . ' ' . $data['zona_waktu_kelas'];

                $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $row, $data['ujian_id'])
                ->setCellValue('B' . $row, $data['nis'])
                ->setCellValue('C' . $row, $data['nama_peserta'])
                ->setCellValue('D' . $row, $data['jenkel'])
                ->setCellValue('E' . $row, $data['nama_kelas'])
                ->setCellValue('F' . $row, $data['angkatan_kelas'])
                ->setCellValue('G' . $row, $data['nama_pengajar'])
                ->setCellValue('H' . $row, $data['hari_kelas'])
                ->setCellValue('I' . $row, $waktu)
                ->setCellValue('J' . $row, $data['tgl_ujian'])
                ->setCellValue('K' . $row, $data['waktu_ujian'])
                ->setCellValue('L' . $row, $data['nilai_ujian'])
                ->setCellValue('M' . $row, $data['nilai_akhir'])
                ->setCellValue('N' . $row, $data['status_peserta_kelas']);

            $sheet->getStyle('A' . $row)->applyFromArray($border);
            $sheet->getStyle('B' . $row)->applyFromArray($border);
            $sheet->getStyle('C' . $row)->applyFromArray($border);
            $sheet->getStyle('D' . $row)->applyFromArray($border);
            $sheet->getStyle('E' . $row)->applyFromArray($border);
            $sheet->getStyle('F' . $row)->applyFromArray($border);
            $sheet->getStyle('G' . $row)->applyFromArray($border);
            $sheet->getStyle('H' . $row)->applyFromArray($border);
            $sheet->getStyle('I' . $row)->applyFromArray($border);
            $sheet->getStyle('J' . $row)->applyFromArray($border);
            $sheet->getStyle('K' . $row)->applyFromArray($border);
            $sheet->getStyle('L' . $row)->applyFromArray($border);
            $sheet->getStyle('M' . $row)->applyFromArray($border);
            $sheet->getStyle('N' . $row)->applyFromArray($border);

            $row++;
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename =  'Data-Rekap-Ujian-Peserta-'. date('Y-m-d-His');

        // Data Log START
        $log = [
            'username_log' => session()->get('username'),
            'tgl_log'      => date("Y-m-d"),
            'waktu_log'    => date("H:i:s"),
            'status_log'   => 'BERHASIL',
            'aktivitas_log'=> 'Download Data Rekap Ujian Peserta via Export Excel, Waktu : ' .  date('Y-m-d-H:i:s'),
        ];
        $this->log->insert($log);
        // Data Log END

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function rekap_ujian_peserta_import()
    {
        $pst_or_pgj = $this->request->getVar('pst_or_pgj');
        $file   = $this->request->getFile('file_excel');
        $ext    = $file->getClientExtension();

        if ($ext == 'xls') {
            $render     = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } else{
            $render     = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }

        $spreadsheet = $render->load($file);
        $sheet       = $spreadsheet->getActiveSheet()->toArray();

        $jumlaherror   = 0;
        $jumlahsukses  = 0;

        foreach ($sheet as $x => $excel) {

            //Skip row pertama - keempat (judul tabel)
            if ($x == 0) {
                continue;
            }
            if ($x == 1) {
                continue;
            }
            if ($x == 2) {
                continue;
            }
            if ($x == 3) {
                continue;
            }

            //Skip data akun username duplikat
            $ujian    = $this->ujian->cek_ujian($excel['0']);
            if ($ujian != 1 ) {
                $jumlaherror++;
            } elseif($ujian == 1) {

                $jumlahsukses++;

                $id_ujian = $excel['0'];
                $get_id_peserta_kelas = $this->peserta_kelas->get_peserta_kelas_id_ujian($id_ujian);
                $peserta_kelas_id = $get_id_peserta_kelas-> peserta_kelas_id;

                $data1   = [
                    'tgl_ujian'                => $excel['9'],
                    'waktu_ujian'              => $excel['10'],
                    'nilai_ujian'              => $excel['11'],
                    'nilai_akhir'              => $excel['12'],
                ];

                $this->ujian->update($id_ujian, $data1);

                $data2   = [
                    'status_peserta_kelas'                => $excel['13'],
                ];

                $this->peserta_kelas->update($peserta_kelas_id, $data2);

                //Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'status_log'   => 'BERHASIL',
                    'aktivitas_log'=> 'Ubah Data Ujian via Import Excel, NIS : ' .   $excel['1'] .  ' Nama : '. $excel['2'],
                ];
                $this->log->insert($log);
                //Data Log END
            }
        }

        $this->session->setFlashdata('pesan_sukses', "Data Excel Berhasil Import = $jumlahsukses <br> Data Gagal Import = $jumlaherror");
        return redirect()->to('/auth/akademik/admin_rekap_ujian');
        
    }

    public function admin_sertifikat()
    {
        $uri                = service('uri');
        $get_periode_url   = $uri->getSegment(4);
        if ($get_periode_url == NULL) {
            $get_periode       = $this->konfigurasi->periode_sertifikat();
            //Periode Cetak Sertifiakt
            $periode           = $get_periode->periode_sertifikat;
        } elseif ($get_periode_url != NULL) {
            $periode = $get_periode_url;
        }
        
        $list_periode      = $this->sertifikat->list_unik_periode();
        $list_sertifikat    = $this->sertifikat->list($periode);

        $data = [
            'title'         => 'Al-Haqq - Data Cetak Sertifikat Peserta Periode ' . $periode,
            'list'          => $list_sertifikat,
            'list_periode'  => $list_periode,
            'periode_pilih' => $periode,
        ];
        return view('auth/akademik/rekap_sertifikat', $data);
    }

    public function input_atur_sertifikat()
    {
        if ($this->request->isAJAX()) {

            $data = [
                'title'   => 'Form Pengaturan Pendaftaran Sertifikat',
                'konfig'  => $this->konfigurasi->list()
            ];
            $msg = [
                'sukses' => view('auth/akademik/atur_sertifikat', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpan_atur_sertifikat()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'periode_sertifikat' => [
                    'label' => 'periode_sertifikat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'status_menu_sertifikat' => [
                    'label' => 'status_menu_sertifikat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'biaya_sertifikat' => [
                    'label' => 'biaya_sertifikat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'periode_sertifikat'        => $validation->getError('periode_sertifikat'),
                        'status_menu_sertifikat'     => $validation->getError('status_menu_sertifikat'),
                        'biaya_sertifikat'        => $validation->getError('biaya_sertifikat'),
                    ]
                ];
            } else {

                $periode_sertifikat = $this->request->getVar('periode_sertifikat');
                $status_menu_sertifikat   = $this->request->getVar('status_menu_sertifikat');
                //Get data nominal rupiah
                $get_biaya_sertifikat = $this->request->getVar('biaya_sertifikat');
                $biaya_sertifikat_int   = str_replace(str_split('Rp. .'), '', $get_biaya_sertifikat);
                $biaya_sertifikat    = $biaya_sertifikat_int;

                $data = [
                    'periode_sertifikat'            => $periode_sertifikat,
                    'status_menu_sertifikat'         => $status_menu_sertifikat,
                    'biaya_sertifikat'            => $biaya_sertifikat, 
                ];

                $konfig_id = 1;

                $this->konfigurasi->update($konfig_id, $data);

                // Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'status_log'   => 'BERHASIL',
                    'aktivitas_log'=> 'Ubah Pengaturan Cetak Sertifikat Menjadi : ' .   $status_menu_sertifikat . ' | Periode Cetak Sertifikat : ' . $periode_sertifikat . ' | Biaya Cetak : ' . $biaya_sertifikat,
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'admin_sertifikat'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function input_konfirmasi_sertifikat()
    {
        if ($this->request->isAJAX()) {

            $sertifikat_id   = $this->request->getVar('sertifikat_id');
            $data_sertifikat = $this->sertifikat->find($sertifikat_id);
            $peserta_id      = $data_sertifikat['sertifikat_peserta_id'];
            $data_peserta    = $this->peserta->find($peserta_id); 

            $data = [
                'title'                 => 'Konfirmasi Pendaftaran Sertifikat',
                'sertifikat_id'         => $sertifikat_id,
                'data_sertifikat'       => $data_sertifikat,
                'nama_peserta'          => $data_peserta[0]['nama_peserta'],
                'nis'                   => $data_peserta[0]['nis'],
                'sertifikat_level'      => $data_sertifikat[0]['sertifikat_level'],
                'nominal_bayar_cetak'   => $data_sertifikat[0]['nominal_bayar_cetak'],
                'keterangan_cetak'      => $data_sertifikat[0]['keterangan_cetak']
            ];
            $msg = [
                'sukses' => view('auth/akademik/konfirmasi_sertifikat', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpan_konfirmasi_sertifikat()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nominal_bayar_cetak' => [
                    'label' => 'nominal_bayar_cetak',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nominal_bayar_cetak'      => $validation->getError('nominal_bayar_cetak'),
                    ]
                ];
            } else {

                $dt = date("Y-m-d H:i:s");

                $get_nominal_bayar_cetak        =  $this->request->getVar('nominal_bayar_cetak');
                $keterangan_cetak               =  $this->request->getVar('keterangan_cetak');
                $nominal_bayar_cetak            = str_replace(str_split('Rp. .'), '', $get_nominal_bayar_cetak);

                $data = [
                    'nominal_bayar_cetak'  => $nominal_bayar_cetak ,
                    'status_cetak'         => 'Terkonfirmasi',
                    'keterangan_cetak'     => $keterangan_cetak,
                    'dt_konfirmasi'        => $dt,
                ];

                $sertifikat_id = $this->request->getVar('sertifikat_id');

                $this->sertifikat->update($sertifikat_id , $data);

                $data_sertifikat = $this->sertifikat->find($sertifikat_id);
                $peserta_id      = $data_sertifikat['sertifikat_peserta_id'];
                $data_peserta    = $this->peserta->find($peserta_id);

                // Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'status_log'   => 'BERHASIL', 
                    'aktivitas_log'=> 'Konfirmasi Pendaftaran Cetak Sertifikat ' .  $data_peserta[0]['nis'] . ' ' . $data_peserta[0]['nama_peserta'],
                ];
                //var_dump($log);
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'admin_sertifikat'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function input_edit_sertifikat()
    {
        if ($this->request->isAJAX()) {

            $sertifikat_id   = $this->request->getVar('sertifikat_id');
            $data_sertifikat = $this->sertifikat->find($sertifikat_id);
            $peserta_id      = $data_sertifikat['sertifikat_peserta_id'];
            $data_peserta    = $this->peserta->find($peserta_id); 

            $data = [
                'title'                 => 'Edit Data Pendaftaran Sertifikat',
                'sertifikat_id'         => $sertifikat_id,
                'data_sertifikat'       => $data_sertifikat,
                'nama_peserta'          => $data_peserta[0]['nama_peserta'],
                'nis'                   => $data_peserta[0]['nis'],
                'sertifikat_level'      => $data_sertifikat[0]['sertifikat_level'],
                'nominal_bayar_cetak'   => $data_sertifikat[0]['nominal_bayar_cetak'],
                'keterangan_cetak'      => $data_sertifikat[0]['keterangan_cetak'],
                'nomor_sertifikat'      => $data_sertifikat[0]['nomor_sertifikat'],
                'status_cetak'          => $data_sertifikat[0]['status_cetak'],
                'link_cetak'            => $data_sertifikat[0]['link_cetak'],
            ];
            $msg = [
                'sukses' => view('auth/akademik/edit_sertifikat', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpan_edit_sertifikat()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nominal_bayar_cetak' => [
                    'label' => 'nominal_bayar_cetak',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'sertifikat_level' => [
                    'label' => 'sertifikat_level',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nominal_bayar_cetak'      => $validation->getError('nominal_bayar_cetak'),
                        'sertifikat_level'      => $validation->getError('sertifikat_level'),
                    ]
                ];
            } else {

                $dt = date("Y-m-d H:i:s");

                $get_nominal_bayar_cetak        =  $this->request->getVar('nominal_bayar_cetak');
                $keterangan_cetak               =  $this->request->getVar('keterangan_cetak');

                $sertifikat_level               =  $this->request->getVar('sertifikat_level');
                $status_cetak                   =  $this->request->getVar('status_cetak');
                $nomor_sertifikat               =  $this->request->getVar('nomor_sertifikat');
                $link_cetak                     =  $this->request->getVar('link_cetak');

                $nominal_bayar_cetak            = str_replace(str_split('Rp. .'), '', $get_nominal_bayar_cetak);

                $data = [
                    'nominal_bayar_cetak'  => $nominal_bayar_cetak ,
                    'sertifikat_level'     => $sertifikat_level,
                    'status_cetak'         => $status_cetak,
                    'nomor_sertifikat'     => $nomor_sertifikat,
                    'link_cetak'           => $link_cetak,
                    'keterangan_cetak'     => $keterangan_cetak,
                    'dt_konfirmasi'        => $dt,
                ];

                $sertifikat_id = $this->request->getVar('sertifikat_id');

                $this->sertifikat->update($sertifikat_id , $data);

                $data_sertifikat = $this->sertifikat->find($sertifikat_id);
                $peserta_id      = $data_sertifikat['sertifikat_peserta_id'];
                $data_peserta    = $this->peserta->find($peserta_id);

                // Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'status_log'   => 'BERHASIL', 
                    'aktivitas_log'=> 'Ubah Data Pendaftaran Cetak Sertifikat ' .  $data_peserta[0]['nis'] . ' ' . $data_peserta[0]['nama_peserta'],
                ];
                //var_dump($log);
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'admin_sertifikat'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function peserta_sertifikat()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('login');
        }

        //Get data peserta
        $user_id = session()->get('user_id');
        $get_peserta = $this->peserta->get_peserta_id($user_id);
        $peserta_id = $get_peserta->peserta_id;

        $get_periode_cetak = $this->konfigurasi->periode_sertifikat();
        $periode_cetak = $get_periode_cetak->periode_sertifikat;
        $get_status_menu_sertifikat = $this->konfigurasi->status_menu_sertifikat();
        $status_menu_sertifikat = $get_status_menu_sertifikat -> status_menu_sertifikat;
        $get_biaya_sertifikat = $this->konfigurasi->biaya_sertifikat();
        $biaya_sertifikat = $get_biaya_sertifikat->biaya_sertifikat;

        $list = $this->sertifikat->list_peserta($peserta_id);

        $data = [
            'title'                     => 'Al-Haqq - Pengajuan Cetak Sertifikat Peserta Periode ' . $periode_cetak,
            'status_menu_sertifikat'    => $status_menu_sertifikat,
            'list'                      => $list,
            'peserta_id'                => $peserta_id,
            'biaya_sertifikat'          => $biaya_sertifikat,
        ];
        return view('auth/akademik/peserta_sertifikat', $data);
    }

    public function input_pengajuan_sertifikat()
    {
        if ($this->request->isAJAX()) {

            $get_periode_cetak = $this->konfigurasi->periode_sertifikat();
            $periode_cetak = $get_periode_cetak->periode_sertifikat;

            $data = [
                'title'         => 'Form Pengajuan Cetak Sertifikat Periode ' . $periode_cetak,
                'peserta_id'    => $this->request->getVar('peserta_id'),
                'periode_cetak' => $periode_cetak,
                // 'list_level'    => $this->level->list(),
            ];
            $msg = [
                'sukses' => view('auth/akademik/pengajuan_sertifikat', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpan_pengajuan_sertifikat()
    {
            $validation = \Config\Services::validation();
            $user_nama = session()->get('nama');
            //Get Tgl Today
            $dt = date("Y-m-d H:i:s");
            $tgl = date("Y-m-d");
            $strwaktu = date("H-i-s");

            $valid = $this->validate([
                'sertifikat_level' => [
                    'label' => 'sertifikat_level',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'nominal_bayar_cetak' => [
                    'label' => 'nominal_bayar_cetak',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'foto' => [
                    'rules' => 'uploaded[foto]|mime_in[foto,image/png,image/jpg,image/jpeg]|is_image[foto]',
                    'errors' => [
                        'mime_in' => 'Harus gambar!'
                    ]
                ]
            ]);

            if (!$valid) {
                $this->session->setFlashdata('pesan_error', 'ERROR! Seluruh Form Input Bertanda * Wajib Diisi dan Harap Upload Bukti Bayar!');
                return redirect()->to('peserta_sertifikat');
            } else {

                // get file foto from input
                $filefoto = $this->request->getFile('foto');
                // ambil nama file
                $namafoto = $filefoto->getName();
                // nama foto baru
                $namafoto_new = $user_nama . '_'. $tgl . '_' . $strwaktu .'_'. $namafoto;

                //Get from form input view modal
                $get_nominal_bayar_cetak        =  $this->request->getVar('nominal_bayar_cetak');

                //Replace Rp. and thousand separtor from input
                $nominal_bayar_cetak           = str_replace(str_split('Rp. .'), '', $get_nominal_bayar_cetak);

                //Get Data from Input view
                $sertifikat_peserta_id  =  $this->request->getVar('sertifikat_peserta_id');
                $periode_cetak          =  $this->request->getVar('periode_cetak');
                $sertifikat_level       =  $this->request->getVar('sertifikat_level');
                $keterangan_cetak       =  $this->request->getVar('keterangan_cetak');
                

                $simpandata = [
                    'sertifikat_peserta_id'     => $sertifikat_peserta_id,
                    'periode_cetak'             => $periode_cetak,
                    'nominal_bayar_cetak'       => $nominal_bayar_cetak,
                    'sertifikat_level'          => $sertifikat_level,
                    'status_cetak'              => 'Proses',
                    'bukti_bayar_cetak'         => $namafoto_new,
                    'keterangan_cetak'          => $keterangan_cetak ,
                    'dt_ajuan'                  => $dt,
                    'dt_konfirmasi'             => '1000-01-01 00:00:00',
                ];
                
                // insert status konfirmasi
                $this->sertifikat->insert($simpandata);

                $filefoto->move('img/transfer/', $namafoto_new);
                
                $this->session->setFlashdata('pesan_sukses', 'Data Pengajuan Cetak Sertifikat Berhasil!');
                return redirect()->to('peserta_sertifikat');
            }
    }
}
