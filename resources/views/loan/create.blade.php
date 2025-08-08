@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="col-md-8 mx-auto ">
        <div class="card mb-5">
            <div class="card-header text-center">
                <h3>Create Loan EMI</h3>
            </div>

        </div>

    <!-- <h2>Loan EMI Form</h2> -->
    <form method="POST" action="{{ route('loan.store') }}">
        @csrf
         <div class="row mb-3">
            <div class="col-md-6">
        <label for="clientid" class="form-label">Client ID</label>
        <input type="number" name="clientid" class="form-control  @if($errors->has('clientid'))  is-invalid @endif"   value="{{ old('clientid') }}">
          @if($errors->has('clientid'))
                  <div class="invalid-feedback">
                    {{ $errors->first('clientid') }}
                  </div>
                @endif
        </div>
            <div class="col-md-6">
        <label  for="num_of_payment" class="form-label">Number of Payments (EMI)</label>
        <input type="number" name="num_of_payment"  class="form-control @if($errors->has('num_of_payment'))  is-invalid @endif"   value="{{ old('num_of_payment') }}" >  @if($errors->has('num_of_payment'))
                  <div class="invalid-feedback">
                    {{ $errors->first('num_of_payment') }}
                  </div>
                @endif
       </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
        <label for="first_payment_date" class="form-label" >First Payment Date</label>
        <input type="date" name="first_payment_date" class="form-control @if($errors->has('first_payment_date'))  is-invalid @endif"   value="{{ old('first_payment_date') }}" >  @if($errors->has('first_payment_date'))
                  <div class="invalid-feedback">
                    {{ $errors->first('first_payment_date') }}
                  </div>
                @endif
            </div>
             <div class="col-md-6">

        <label for="last_payment_date" class="form-label" >Last Payment Date</label>
        <input type="date" name="last_payment_date"  class="form-control @if($errors->has('last_payment_date'))  is-invalid @endif"   value="{{ old('last_payment_date') }}" >  @if($errors->has('last_payment_date'))
                  <div class="invalid-feedback">
                    {{ $errors->first('last_payment_date') }}
                  </div>
                @endif
   </div>
   </div>
    <div class="row mb-3">
            <div class="col-md-12">
        <label for="loan_amount" class="form-label">Total Loan Amount</label>
        <input type="number" step="0.01" name="loan_amount" class="form-control @if($errors->has('loan_amount'))  is-invalid @endif"   value="{{ old('loan_amount') }}" >  @if($errors->has('loan_amount'))
                  <div class="invalid-feedback">
                    {{ $errors->first('loan_amount') }}
                  </div>
                @endif
  </div>
    <div class="py-3 text-center">
            <button type="submit" class="btn btn-dark">Save Product</button>
            <button type="reset" class="btn btn-danger">Clear All</button>
        </div>
</div>
</div>
@endsection
