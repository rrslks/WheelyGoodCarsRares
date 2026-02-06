@extends('layouts.app')
@section('content')
{{-- Progressbar --}}
<div class="progress mb-4">
    <div class="progress-bar bg-primary" role="progressbar" style="width: 66%">
        Stap 2/3
    </div>
</div>

<h2>Stap 2: Controleer en vul details aan</h2>
<form action="{{ route('cars.create.step2') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="brand">Merk</label>
        <input type="text" name="brand" id="brand" class="form-control"
               value="{{ session('car.details.brand') ?? '' }}" required>
    </div>

    <div class="mb-3">
        <label for="model">Model</label>
        <input type="text" name="model" id="model" class="form-control"
               value="{{ session('car.details.model') ?? '' }}" required>
    </div>

    <div class="mb-3">
        <label for="year">Bouwjaar</label>
        <input type="number" name="year" id="year" class="form-control"
               value="{{ session('car.details.year') ?? '' }}" required>
    </div>

    <div class="mb-3">
        <label for="color">Kleur</label>
        <input type="text" name="color" id="color" class="form-control"
               value="{{ session('car.details.color') ?? '' }}">
    </div>

    <div class="mb-3">
        <label for="mileage">Kilometers</label>
        <input type="number" name="mileage" id="mileage" class="form-control"
               value="{{ session('car.details.mileage') ?? '' }}">
    </div>

    <div class="mb-3">
        <label for="price">Vraagprijs (€)</label>
        <input type="number" name="price" id="price" class="form-control"
               value="{{ session('car.details.price') ?? '' }}" required>
    </div>

    <button class="btn btn-primary">Volgende</button>
</form>
@endsection
