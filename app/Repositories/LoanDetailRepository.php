<?php
namespace App\Repositories;

use App\Models\LoanDetail;
use App\Repositories\Interfaces\LoanDetailRepositoryInterface;

class LoanDetailRepository implements LoanDetailRepositoryInterface
{
    public function all()
    {
        return LoanDetail::all();
    }

    public function find($id)
    {
        return LoanDetail::findOrFail($id);
    }

    public function create(array $data)
    {
        return LoanDetail::create($data);
    }

    public function update($id, array $data)
    {
        $loan = LoanDetail::findOrFail($id);
        $loan->update($data);
        return $loan;
    }

    public function delete($id)
    {
        $loan = LoanDetail::findOrFail($id);
        return $loan->delete();
    }
   
}
