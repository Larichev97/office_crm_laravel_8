<?php

namespace App\Imports;

use App\Models\Client\Client;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ClientsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $client = new Client([
            "first_name" => $row['first_name'],
            "last_name" => $row['last_name'],
            "surname" => $row['surname'],
            "mobile_number" => $row['mobile_number'],
            "status_id" => 1, // New
            "agent_id" => null,
        ]);

        return $client;
    }
}
