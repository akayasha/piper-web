<?php

namespace App\Exports\Transaction;

use App\Models\Payment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TemplateExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize, WithTitle
{
    /**
     * Specify the collection of data to export
     */
    public function collection()
    {
        return Payment::with('redeemCode.branch')->get();
    }

    /**
     * Define the headings for the export
     */
    public function headings(): array
    {
        return [
            'No',
            'Branch',
            'Invoice Number',
            'Transaction ID',
            'Price',
            'Status',
            'Strip',
            'Payment Method',
            'Date',
        ];
    }

    /**
     * Map the data for each row
     */
    public function map($payment): array
    {
        static $index = 1;

        return [
            $index++,
            $payment->redeemCode->branch->name ?? '-',
            $payment->invoice_number,
            $payment->transaction_id,
            $payment->price ? number_format($payment->price, 2, ',', '.') : '-',
            $payment->status,
            $payment->strip,
            $payment->payment_method,
            $payment->created_at,
        ];
    }

    /**
     * Apply styles to the sheet.
     *
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        $highestColumn = $sheet->getHighestColumn();
        $highestRow = $sheet->getHighestRow();

        $sheet->getStyle('A1:' . $highestColumn . '1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '162c41'],
            ]
        ]);

        $sheet->getStyle('A1:' . $highestColumn . $highestRow)
            ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        $sheet->setAutoFilter('A1:' . $highestColumn . '1');

        $sheet->getStyle('A2:' . $highestColumn . $highestRow)
            ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        foreach ($sheet->getColumnIterator('F') as $column) {
            foreach ($column->getCellIterator() as $cell) {
                if ($cell->getRow() > 1) {
                    $status = $cell->getValue();
                    if ($status === 'pending') {
                        $cell->getStyle()->applyFromArray([
                            'fill' => [
                                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                                'startColor' => ['rgb' => 'D3D3D3'],
                            ],
                            'font' => [
                                'color' => ['rgb' => '000000'],
                            ],
                        ]);
                    } elseif ($status === 'completed') {
                        $cell->getStyle()->applyFromArray([
                            'fill' => [
                                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                                'startColor' => ['rgb' => '008000'],
                            ],
                            'font' => [
                                'color' => ['rgb' => 'FFFFFF'],
                            ],
                        ]);
                    }
                }
            }
        }

        return [];
    }


        /**
     * Title of the worksheet.
     *
     * @return string
     */
    public function title(): string
    {
        return 'List Transaction Data';
    }
}
