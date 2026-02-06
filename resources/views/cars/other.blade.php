@extends('layouts.app')

@section('content')
<h2>Andere auto's</h2>

<div class="row">
@foreach($cars as $car)
<div class="col-md-4 mb-3">
    <div class="card h-100">
        @if($car->image)
        <img src="{{ asset('storage/' . $car->image) }}"
             alt="Foto van {{ $car->brand }} {{ $car->model }}"
             class="card-img-top"
             style="height:200px; object-fit:cover;">
        @endif
        <div class="card-body">
            <h5>{{ $car->brand }} {{ $car->model }}</h5>
            <p>Bouwjaar: {{ $car->year }}</p>
            <p>Kleur: {{ $car->color }}</p>
            <p>Prijs: € {{ number_format($car->price,2) }}</p>
            <p>Aangeboden door: {{ $car->user->name }}</p>
            <a href="{{ route('public.cars.show', $car) }}" class="btn btn-primary mt-2">Bekijk</a>
        </div>
    </div>
</div>
@endforeach
</div>

<div class="mt-4">{{ $cars->links() }}</div>
@endsection
