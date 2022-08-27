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
            "full_name" => $row['full_name'],
            "address" => $row['address'],
            "mobile_number" => $row['mobile_number'],
            "status_id" => 1, // New client
            "agent_id" => null,
            "comment" => null,
        ]);

        return $client;
    }
}
