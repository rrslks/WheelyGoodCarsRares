@extends('layouts.app')

@section('content')
<div class="container">

<h2>Auto bewerken</h2>

<form method="POST" action="{{ route('cars.update',$car) }}">
@csrf
@method('PUT')

<div class="mb-3">
<label>Merk</label>
<input type="text" name="brand" class="form-control"
value="{{ old('brand',$car->brand) }}">
</div>

<div class="mb-3">
<label>Model</label>
<input type="text" name="model" class="form-control"
value="{{ old('model',$car->model) }}">
</div>

<div class="mb-3">
<label>Bouwjaar</label>
<input type="number" name="year" class="form-control"
value="{{ old('year',$car->year) }}">
</div>

<div class="mb-3">
<label>Kleur</label>
<input type="text" name="color" class="form-control"
value="{{ old('color',$car->color) }}">
</div>

<div class="mb-3">
<label>Kilometerstand</label>
<input type="number" name="mileage" class="form-control"
value="{{ old('mileage',$car->mileage) }}">
</div>

<div class="mb-3">
<label>Prijs</label>
<input type="number" step="0.01" name="price" class="form-control"
value="{{ old('price',$car->price) }}">
</div>

<hr>

<h4>Tags</h4>

<div class="row">

@foreach($tags as $tag)

<div class="col-md-3 mb-2">
<div class="form-check border p-2 rounded">

<input
class="form-check-input"
type="checkbox"
name="tags[]"
value="{{ $tag->id }}"
id="tag{{ $tag->id }}"

{{ $car->tags->contains($tag->id) ? 'checked' : '' }}
>

<label class="form-check-label" for="tag{{ $tag->id }}">
{{ $tag->name }}
</label>

</div>
</div>

@endforeach

</div>

<button class="btn btn-success mt-3">Opslaan</button>

</form>

</div>
@endsection
