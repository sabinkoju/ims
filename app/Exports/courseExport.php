<?php

namespace App\Exports;

use App\Course;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class courseExport implements WithHeadings, FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
     */


    public function collection()
    {
        $courseData = Course::select('id', 'name', 'code', 'duration', 'fees')->where('status',1)->orderBy('id', 'DESC')->get();
        return $courseData;

    }

    public function headings(): array
    {
      return ['S.N.', 'Course Name', 'Course Code', 'Duration', 'Fees'];
    }
}
