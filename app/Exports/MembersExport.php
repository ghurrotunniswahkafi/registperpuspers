<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class MembersExport implements FromArray, WithTitle, WithStyles
{
    protected $periode;
    protected $members;

    public function __construct($members, $periode = null)
    {
        $this->members = $members;
        $this->periode = $periode;
    }

    /**
     * @return array
     */
    public function array(): array
    {
        $data = [
            ['Laporan Anggota Perpustakaan'],
            ['Perpustakaan Monumen Pers Nasional'],
            ['Periode: ' . $this->getPeriodeText()],
            [''],
            ['No', 'Nomor Keanggotaan', 'Nama Anggota', 'Jenis Keanggotaan', 'Tanggal Daftar'],
        ];
        
        foreach ($this->members as $index => $member) {
            if (is_object($member)) {
                $id = $member->id ?? 1;
                $nomorKeanggotaan = $member->nomor_keanggotaan ?? null;
                $nama = $member->nama ?? '';
                $jenis = $member->jenis_keanggotaan ?? 'Umum';
                $createdAt = $member->created_at ?? now();
            } else {
                $id = $member['id'] ?? 1;
                $nomorKeanggotaan = $member['nomor_keanggotaan'] ?? null;
                $nama = $member['nama'] ?? '';
                $jenis = $member['jenis_keanggotaan'] ?? 'Umum';
                $createdAt = $member['created_at'] ?? now();
            }

            $data[] = [
                $index + 1,
                $nomorKeanggotaan ?: str_pad($id, 4, '0', STR_PAD_LEFT) . 'MPN' . \Carbon\Carbon::parse($createdAt)->format('Y'),
                $nama,
                $jenis,
                \Carbon\Carbon::parse($createdAt)->format('d/m/Y'),
            ];
        }

        return $data;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Laporan Anggota';
    }

    /**
     * @param Worksheet $sheet
     */
    public function styles(Worksheet $sheet)
    {
        $primaryBlue = '1F4E79';
        $lightBlue = 'D9EAF7';

        $sheet->getColumnDimension('A')->setWidth(8);
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(30);
        $sheet->getColumnDimension('D')->setWidth(22);
        $sheet->getColumnDimension('E')->setWidth(18);

        $sheet->getStyle('A1:E1')->applyFromArray([
            'font' => ['bold' => true, 'size' => 14, 'name' => 'Arial', 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $primaryBlue]],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
        ]);
        $sheet->mergeCells('A1:E1');
        $sheet->getRowDimension(1)->setRowHeight(26);

        $sheet->getStyle('A2:E3')->applyFromArray([
            'font' => ['size' => 11, 'name' => 'Arial', 'color' => ['rgb' => $primaryBlue]],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $lightBlue]],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
        ]);
        $sheet->mergeCells('A2:E2');
        $sheet->mergeCells('A3:E3');
        $sheet->getRowDimension(2)->setRowHeight(20);
        $sheet->getRowDimension(3)->setRowHeight(20);

        $sheet->getRowDimension(4)->setRowHeight(8);

        $sheet->getStyle('A5:E5')->applyFromArray([
            'font' => ['bold' => true, 'name' => 'Arial', 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $primaryBlue]],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN],
            ],
        ]);
        $sheet->getRowDimension(5)->setRowHeight(22);

        // ===== DATA ROWS =====
        $rowCount = count($this->members);
        if ($rowCount > 0) {
            $dataStartRow = 6;
            $dataEndRow = $dataStartRow + $rowCount - 1;

            $sheet->getStyle('A' . $dataStartRow . ':E' . $dataEndRow)->applyFromArray([
                'font' => ['name' => 'Arial'],
                'borders' => [
                    'allBorders' => ['borderStyle' => Border::BORDER_THIN],
                ],
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ]);

            $sheet->getStyle('A' . $dataStartRow . ':A' . $dataEndRow)->applyFromArray([
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ]);

            $sheet->getStyle('E' . $dataStartRow . ':E' . $dataEndRow)->applyFromArray([
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ]);
        }

        $summaryRow = 5 + $rowCount + 2;
        $sheet->setCellValue('A' . $summaryRow, 'Total data: ' . $rowCount . ' anggota');
        $sheet->getStyle('A' . $summaryRow)->applyFromArray([
            'font' => ['bold' => true, 'size' => 11, 'name' => 'Arial'],
        ]);
        $sheet->mergeCells('A' . $summaryRow . ':E' . $summaryRow);
        $sheet->getStyle('A' . $summaryRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

        return [];
    }

    private function getPeriodeText()
    {
        if (! $this->periode) {
            return '-';
        }

        $bulan = substr($this->periode, 5, 2);
        $tahun = substr($this->periode, 0, 4);

        return $this->getBulanIndo($bulan) . ' ' . $tahun;
    }

    private function getBulanIndo($bulan)
    {
        $bulanIndo = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];

        return $bulanIndo[$bulan] ?? $bulan;
    }
}
