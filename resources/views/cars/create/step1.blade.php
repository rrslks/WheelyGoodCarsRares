@extends('layouts.app')
@section('content')
{{-- Progressbar --}}
<div class="progress mb-4">
    <div class="progress-bar bg-primary" role="progressbar" style="width: 33%">
        Stap 1/3
    </div>
</div>

<h2>Stap 1: Vul het kenteken in</h2>
<form action="{{ route('cars.create.step1') }}" method="POST">
    @csrf
   <div class="d-flex justify-content-center mb-4">

    <div class="license-plate">
        <span class="nl">NL</span>

        <input
            type="text"
            name="license_plate"
            id="license_plate"
            maxlength="8"
            placeholder="XX-999-XX"
            required
        >

        <style>
            .license-plate {
    display: flex;
    align-items: center;
    background: #f7d117;
    border-radius: 6px;
    padding: 6px;
    width: 320px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.license-plate .nl {
    background: #003399;
    color: white;
    padding: 8px 6px;
    font-weight: bold;
    border-radius: 4px 0 0 4px;
    margin-right: 8px;
}

.license-plate input {
    border: none;
    background: transparent;
    font-size: 24px;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 3px;
    width: 100%;
    outline: none;
}
        </style>
    </div>

</div>
    <button class="btn btn-primary">Volgende</button>
</form>
@endsection
