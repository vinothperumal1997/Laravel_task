<?php

namespace App\Services;

use App\Repositories\Interfaces\LoanDetailRepositoryInterface;

class LoanDetailService
{
    protected $loanRepo;

    public function __construct(LoanDetailRepositoryInterface $loanRepo)
    {
        $this->loanRepo = $loanRepo;
    }

    public function getAllLoans()
    {
        return $this->loanRepo->all();
    }

    public function createLoan(array $data)
    {
        return $this->loanRepo->create($data);
    }

    public function updateLoan($id, array $data)
    {
        return $this->loanRepo->update($id, $data);
    }

    public function deleteLoan($id)
    {
        return $this->loanRepo->delete($id);
    }
    public function storeLoanDetail(array $data)
{
    return $this->loanRepo->create($data);
}
}
