<?php

namespace App\Exports;

use App\Section;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class sectionExport implements WithHeadings, FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
     */


    public function collection()
    {
        $sectionData = Section::select('id', 'section_name')->orderBy('id', 'ASC')->get();
        return $sectionData;

    }

    public function headings(): array
    {
      return ['S.N.', 'Section Name'];
    }
}
