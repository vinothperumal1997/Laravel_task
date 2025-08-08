<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LoanDetailService;
use App\Models\LoanDetail;
use Illuminate\Support\Facades\DB;

class LoanDetailController extends Controller
{
    protected $loanService;

    public function __construct(LoanDetailService $loanService)
    {
        $this->loanService = $loanService;
    }

    public function create()
    {
        return view('loan.create');
    }
    

    public function store(Request $request)
    {
        $data = $request->validate([
            'clientid' => 'required|integer',
            'num_of_payment' => 'required|integer',
            'first_payment_date' => 'required|date',
            'last_payment_date' => 'required|date',
            'loan_amount' => 'required|numeric',
        ]);

        $this->loanService->storeLoanDetail($data);

        return redirect()->back()->with('success', 'Loan EMI details saved!');
    }
     public function index()
    {
    $loans = LoanDetail::paginate(10); 
        return view('loan.index', compact('loans'));
    }

    public function processEmiData()
{
    $minDate = DB::table('loan_details')->min('first_payment_date');
    $maxDate = DB::table('loan_details')->max('last_payment_date');

    if (!$minDate || !$maxDate) {
        return "No data found in loan_details table.";
    }

    $start = new \DateTime($minDate);
    $end = new \DateTime($maxDate);
    $end->modify('first day of next month');

    $columns = [];
    while ($start < $end) {
        $columns[] = $start->format('Y_M');
        $start->modify('+1 month');
    }

    DB::statement("DROP TABLE IF EXISTS emi_details");

    $sql = "CREATE TABLE emi_details (
        clientid INT";

    foreach ($columns as $col) {
        $sql .= ", `$col` DECIMAL(10,2) DEFAULT 0";
    }

    $sql .= ")";

    DB::statement($sql);

    return "emi_details table created successfully with dynamic columns.";
}

}
