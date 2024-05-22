<?php

namespace App\Imports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\ToModel;

class BooksImport implements ToModel
{
    public function model(array $row)
    {
        return new Book([
            'title'  => $row[0],
            'author' => $row[1],
            'isbn'   => $row[2],
        ]);
    }
}
