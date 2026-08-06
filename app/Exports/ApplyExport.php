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

class ApplyExport implements FromQuery, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    protected $year;
    protected $department;
    protected $rowNumber = 1;

    public function __construct($department = null)
    {
        $this->year = Carbon::now()->year;
        $this->department = $department;
    }

    public function query()
    {
        $query = Apply::with('status', 'document')->whereYear('created_at', $this->year);
        
        if ($this->department && $this->department !== 'All' && $this->department !== '') {
            $query->whereHas('document', function($q) {
                $q->where('department', $this->department);
            });
        }
        
        return $query;
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'Email',
            'Department',
            'Nationality',
            'Link Passport',
            'Link Study Plan',
            'Link English Proficiency',
            'Link Transcript',
            'Link CV',
            'Link Medical Checkup',
            'Link First Letter of Recommendation',
            'Link Second Letter of Recommendation',
            'Link Commitment Letter',
            'Link Statement Letter',
        ];
    }

    public function map($apply): array
    {
        return [
            $this->rowNumber++,
            $apply->document->first_name . ' ' . $apply->document->family_name,
            $apply->document->email,
            $apply->document->department,
            $apply->document->nationality,
            $apply->document->passport ? asset('storage/' . $apply->document->passport) : '',
            $apply->document->study_plan ? asset('storage/' . $apply->document->study_plan) : '',
            $apply->document->english_proficiency ? asset('storage/' . $apply->document->english_proficiency) : '',
            $apply->document->transcript ? asset('storage/' . $apply->document->transcript) : '',
            $apply->document->cv ? asset('storage/' . $apply->document->cv) : '',
            $apply->document->medical_checkup ? asset('storage/' . $apply->document->medical_checkup) : '',
            $apply->document->first_letter_of_recommendation ? asset('storage/' . $apply->document->first_letter_of_recommendation) : '',
            $apply->document->second_letter_of_recommendation ? asset('storage/' . $apply->document->second_letter_of_recommendation) : '',
            $apply->document->commitment_letter ? asset('storage/' . $apply->document->commitment_letter) : '',
            $apply->document->signed_acceptance_letter ? asset('storage/' . $apply->document->signed_acceptance_letter) : '',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        // Style for header
        $sheet->getStyle('A1:' . $highestColumn . '1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '114D91'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Border for all cells
        $sheet->getStyle('A1:' . $highestColumn . $highestRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '00000000'],
                ],
            ],
        ]);

        // Text Alignment for No, Department, Nationality
        $sheet->getStyle('A2:A' . $highestRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('D2:D' . $highestRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('E2:E' . $highestRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        
        return [];
    }
}
