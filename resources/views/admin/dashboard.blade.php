@extends('layouts.app')


@section('content')
<div class="container mt-5">
    <div class="card shadow p-4">
        <h2 class="mb-3">Welcome to Admin Dashboard</h2>
        <p class="text-muted">You are logged in as: <strong>{{ Auth::user()->username }}</strong></p>
    </div>
</div>

@endsection