<?php

namespace App\Repositories;

use App\Models\TrxIzinKeluar;

class IzinKeluarRepository
{
    public function create(array $data)
    {
        return TrxIzinKeluar::create($data);
    }

    public function findById($id)
    {
        return TrxIzinKeluar::find($id);
    }

    public function update($id, array $data)
    {
        $record = TrxIzinKeluar::find($id);
        if ($record) {
            $record->update($data);
            return $record;
        }
        return null;
    }
}
