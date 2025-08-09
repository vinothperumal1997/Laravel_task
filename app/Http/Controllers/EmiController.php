<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class EmiController extends Controller
{
    public function emi()
    {
        $columns = $rows = [];

        if (Schema::hasTable('emi_details')) {
            $columns = DB::getSchemaBuilder()->getColumnListing('emi_details');
            $rows = DB::table('emi_details')->get();
        }

        return view('loan.emi', compact('columns', 'rows'));
    }

    public function process()
    {
        DB::statement('DROP TABLE IF EXISTS emi_details');

        $minDate = DB::table('loan_details')->min('first_payment_date');
        $maxDate = DB::table('loan_details')->max('last_payment_date');

        $start = \Carbon\Carbon::parse($minDate)->startOfMonth();
        $end = \Carbon\Carbon::parse($maxDate)->startOfMonth();

        $months = [];
        while ($start <= $end) {
            $months[] = $start->format('Y_M');
            $start->addMonth();
        }

        $sql = "CREATE TABLE emi_details (clientid INT";
        foreach ($months as $month) {
            $sql .= ", `$month` DECIMAL(10,2) DEFAULT 0.00";
        }
        $sql .= ")";
        DB::statement($sql);

        $loans = DB::table('loan_details')->get();

        foreach ($loans as $loan) {
            $emi = round($loan->loan_amount / $loan->num_of_payment, 2);
            $emiArr = array_fill_keys($months, 0.00);

            $paymentStart = \Carbon\Carbon::parse($loan->first_payment_date)->startOfMonth();
            for ($i = 0; $i < $loan->num_of_payment; $i++) {
                $key = $paymentStart->format('Y_M');

                // Adjust last EMI
                if ($i == $loan->num_of_payment - 1) {
                    $sum = $emi * ($loan->num_of_payment - 1);
                    $emiArr[$key] = round($loan->loan_amount - $sum, 2);
                } else {
                    $emiArr[$key] = $emi;
                }

                $paymentStart->addMonth();
            }

            // Insert into emi_details
            $insert = ['clientid' => $loan->clientid] + $emiArr;
            DB::table('emi_details')->insert($insert);
        }

        return redirect()->route('loan.emi')->with('success', 'EMI table processed.');
    }
}
