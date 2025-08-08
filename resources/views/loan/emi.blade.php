@extends('layouts.app')

@section('content')
<div class="container">
    <h2>EMI Table</h2>

  
    <form action="{{ route('emi.process') }}" method="POST">
        @csrf
        <button class="btn btn-primary mb-3">Process Data</button>
    </form>

    @if(count($columns))
            <div class="col-md-12 table-responsive mt-4">

        <table class="table table-bordered">
            <thead>
                <tr>
                    @foreach($columns as $col)
                        <th>{{ $col }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($rows as $row)
                    <tr>
                        @foreach($columns as $index=> $col)
                          @if($index === 0)
                        <td>{{ $row->$col }}</td> 
                    @else
                        <td>{{ number_format($row->$col, 2) }}</td> 
                    @endif
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    @else
        <p>No EMI Data Available.</p>
    @endif
</div>
@endsection
