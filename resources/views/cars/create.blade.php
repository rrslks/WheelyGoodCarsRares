@extends('layouts.app')
@section('content')
<h2>Auto toevoegen</h2>

<form method="POST" action="{{ route('cars.store') }}" enctype="multipart/form-data">
@csrf

<div class="mb-3"><label>Kenteken</label><input type="text" name="license_plate" class="form-control" required></div>
<div class="mb-3"><label>Merk</label><input type="text" name="brand" class="form-control" required></div>
<div class="mb-3"><label>Model</label><input type="text" name="model" class="form-control" required></div>
<div class="mb-3"><label>Kleur</label><input type="text" name="color" class="form-control"></div>
<div class="mb-3"><label>Bouwjaar</label><input type="number" name="year" class="form-control" required></div>
<div class="mb-3"><label>Kilometers</label><input type="number" name="mileage" class="form-control"></div>
<div class="mb-3"><label>Vraagprijs (€)</label><input type="number" name="price" class="form-control" required></div>
<div class="mb-3"><label>Foto van de auto</label><input type="file" name="image" class="form-control"></div>

<button class="btn btn-success">Opslaan</button>
</form>
@endsection
