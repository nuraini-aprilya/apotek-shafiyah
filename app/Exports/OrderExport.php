<?php

namespace App\Exports;

use App\Models\DetailOrder;
use App\Models\Order;
use App\Models\Profile;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class OrderExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithEvents, WithCustomStartCell
{
    use Exportable;

    protected $startDate;
    protected $endDate;
    protected $row;
    protected $totalBuyPrice = 0;
    protected $totalSellPrice = 0;
    protected $totalProfit = 0;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->row = 0; // Inisialisasi row
    }

    public function collection()
    {
        $data = DetailOrder::with(['product'])
            ->whereHas('order', function ($query) {
                $query->whereBetween('created_at', [$this->startDate, $this->endDate]);
            })->get();

        return $data;
    }

    public function map($detailOrder): array
    {
        $data = [];

        foreach ($detailOrder->product as $product) {
            // Mengambil harga beli dari DetailPurchase
            $buyPrice = 0;
            $invoiceNumber = '';

            // Ambil harga jual dari detail
            $sellPrice = $detailOrder->product->price ?? 0;

            $purchases = $detailOrder->product->purchases;



            $this->totalBuyPrice += $buyPrice;
            $this->totalSellPrice += $sellPrice;
            $this->totalProfit += ($sellPrice - $buyPrice);


            foreach ($purchases as $purchase) {
                $data[] = [
                    $purchase->invoice_number,
                    $detailOrder->created_at->format('Y-m-d') ?? '',
                    $detailOrder->product->name ?? '',
                    $detailOrder->product->type->name ?? '',
                    $detailOrder->amount,
                    'Rp ' . number_format($buyPrice, 0, ',', '.'), // Harga beli
                    'Rp ' . number_format($sellPrice, 0, ',', '.'), // Harga jual
                ];
            }
        }

        return $data;
    }

    public function headings(): array
    {
        return [
            'Kode Invoice',
            'Tanggal',
            'Nama Obat',
            'Jenis Obat',
            'Qty',
            'Harga Beli',
            'Harga Jual',
        ];
    }

    public function startCell(): string
    {
        return 'B10';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $profile = Profile::first();

                // Menyisipkan gambar/logo
                $drawing = new Drawing();
                $drawing->setName('Logo');
                $drawing->setDescription('Logo');
                $drawing->setPath(public_path('template/dist/img/logo ular.png')); // Sesuaikan path logo
                $drawing->setHeight(90); // Tinggi logo
                $drawing->setCoordinates('C2'); // Lokasi penempatan logo
                $drawing->setWorksheet($event->sheet->getDelegate());

                // Menggabungkan sel untuk heading (kop surat)
                $event->sheet->mergeCells('B7:H7');
                $event->sheet->mergeCells('B9:H9');
                $event->sheet->mergeCells('D2:G2');
                $event->sheet->mergeCells('D3:G3');
                $event->sheet->mergeCells('D4:G4');

                // Menambahkan teks kop surat
                $event->sheet->setCellValue('B7', 'Laporan Penjualan');
                $event->sheet->setCellValue('B9', 'Daftar Penjualan Obat');
                $event->sheet->setCellValue('D2', config('app.name'));
                $event->sheet->setCellValue('D3', $profile->address);
                $event->sheet->setCellValue('D4', 'Telp.');

                // Styling kop surat agar teks berada di tengah
                $event->sheet->getStyle('B7:H7')->applyFromArray([
                    'font' => ['size' => 12],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);

                // Mengatur style untuk tabel
                $highestColumn = $event->sheet->getHighestColumn();
                $highestRow = $event->sheet->getHighestRow();

                $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ];

                $range = 'B9:' . $highestColumn . $highestRow;
                $event->sheet->getStyle($range)->applyFromArray($styleArray);

                // Tambahkan total di baris terakhir
                $totalRow = $highestRow + 1;
                $event->sheet->setCellValue('B' . $totalRow, 'Total Harga Beli');
                $event->sheet->setCellValue('G' . $totalRow, 'Rp ' . number_format($this->totalBuyPrice, 0, ',', '.'));

                $totalRow += 1; // Baris berikutnya
                $event->sheet->setCellValue('B' . $totalRow, 'Total Seluruh Penjualan');
                $event->sheet->setCellValue('H' . $totalRow, 'Rp ' . number_format($this->totalSellPrice, 0, ',', '.'));

                $totalRow += 1; // Baris berikutnya
                $event->sheet->setCellValue('B' . $totalRow, 'Total Laba Bersih');
                $event->sheet->setCellValue('G' . $totalRow, 'Rp ' . number_format($this->totalProfit, 0, ',', '.'));

                // Styling untuk baris total
                $event->sheet->getStyle('B' . ($totalRow - 2) . ':' . $highestColumn . $totalRow)->applyFromArray([
                    'font' => ['bold' => true],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);
            },
        ];
    }
}
