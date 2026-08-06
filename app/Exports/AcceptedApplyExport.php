<?php

namespace App\Exports;

use App\Models\Apply;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class AcceptedApplyExport implements FromQuery, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    protected $year;
    protected $department;
    protected $uploadStatus;
    protected $rowNumber = 1;

    public function __construct($department = null, $uploadStatus = null, $year = null)
    {
        $this->year = $year ?? Carbon::now()->year;
        $this->department = $department;
        $this->uploadStatus = $uploadStatus;
    }

    public function query()
    {
        $query = Apply::with('status', 'document')
            ->where('status_id', 5)
            ->whereYear('created_at', $this->year);

        if ($this->department && $this->department !== 'All' && $this->department !== '') {
            $query->whereHas('document', function ($q) {
                $q->where('department', $this->department);
            });
        }

        if ($this->uploadStatus === 'uploaded') {
            $query->whereHas('document', function ($q) {
                $q->whereNotNull('signed_acceptance_letter')
                  ->where('signed_acceptance_letter', '!=', '');
            });
        } elseif ($this->uploadStatus === 'pending') {
            $query->whereHas('document', function ($q) {
                $q->whereNull('signed_acceptance_letter')
                  ->orWhere('signed_acceptance_letter', '=', '');
            });
        }

        return $query->latest();
    }

    public function headings(): array
    {
        return [
            'No',
            'No Register',
            'Nama Lengkap',
            'Email',
            'Phone Number',
            'Department',
            'Nationality',
            'Status Upload Signed Letter',
            'Link Signed Acceptance Letter',
            'Link Passport',
            'Link Study Plan',
            'Link English Proficiency',
            'Link Transcript',
            'Link CV',
            'Link Medical Checkup',
            'Link First Letter of Recommendation',
            'Link Second Letter of Recommendation',
            'Link Commitment Letter',
        ];
    }

    public function map($apply): array
    {
        $hasSigned = !empty($apply->document->signed_acceptance_letter);

        return [
            $this->rowNumber++,
            $apply->no_register ?? '-',
            $apply->document->first_name . ' ' . $apply->document->family_name,
            $apply->document->email,
            $apply->document->phone_number ?? '-',
            $apply->document->department,
            $apply->document->nationality,
            $hasSigned ? 'Sudah Upload' : 'Belum Upload (Pending)',
            $hasSigned ? asset('storage/' . $apply->document->signed_acceptance_letter) : 'Belum Ada',
            $apply->document->passport ? asset('storage/' . $apply->document->passport) : '',
            $apply->document->study_plan ? asset('storage/' . $apply->document->study_plan) : '',
            $apply->document->english_proficiency ? asset('storage/' . $apply->document->english_proficiency) : '',
            $apply->document->transcript ? asset('storage/' . $apply->document->transcript) : '',
            $apply->document->cv ? asset('storage/' . $apply->document->cv) : '',
            $apply->document->medical_checkup ? asset('storage/' . $apply->document->medical_checkup) : '',
            $apply->document->first_letter_of_recommendation ? asset('storage/' . $apply->document->first_letter_of_recommendation) : '',
            $apply->document->second_letter_of_recommendation ? asset('storage/' . $apply->document->second_letter_of_recommendation) : '',
            $apply->document->commitment_letter ? asset('storage/' . $apply->document->commitment_letter) : '',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        // Header style
        $sheet->getStyle('A1:' . $highestColumn . '1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '065F46'], // Emerald Dark Green
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Border styling for all cells
        $sheet->getStyle('A1:' . $highestColumn . $highestRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'D1D5DB'],
                ],
            ],
        ]);

        // Alignment for data rows
        $sheet->getStyle('A2:A' . $highestRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('B2:B' . $highestRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('G2:H' . $highestRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        return [];
    }
}
