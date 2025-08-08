{{-- resources/views/loan/index.blade.php --}}
@extends('layouts.app')


@section('content')
<div class="d-flex justify-content-between align-items-center mt-5">
    <h2 class="mb-4">Loan Details</h2>
    <form method="POST" action="{{ route('emi.process') }}">
    @csrf
    <button type="submit" class="btn btn-primary">Process Data</button>
</form>
</div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Client ID</th>
                <th>No of Payments</th>
                <th>First Payment Date</th>
                <th>Last Payment Date</th>
                <th>Loan Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($loans as $loan)
                <tr>
                    <td>{{ $loan->clientid }}</td>
                    <td>{{ $loan->num_of_payment }}</td>
                    <td>{{ $loan->first_payment_date }}</td>
                    <td>{{ $loan->last_payment_date }}</td>
                    <td>{{ $loan->loan_amount }}</td>
                   
                </tr>
            @endforeach
        </tbody>
    </table>
  <div class="row mt-4 align-items-center">
    {{-- Showing X to Y of Z results (left side) --}}
    <div class="col-md-6">
        <div>
            Showing {{ $loans->firstItem() }} to {{ $loans->lastItem() }} of {{ $loans->total() }} results
        </div>
    </div>

    {{-- Pagination Links (center) --}}
    <div class="col-md-6 d-flex justify-content-center">
        {{ $loans->links('pagination::bootstrap-5') }}
    </div>
</div>


@endsection
