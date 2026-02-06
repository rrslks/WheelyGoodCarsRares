@extends('layouts.app')

@section('content')
<h2>Mijn favorieten</h2>

<div class="row">
@foreach($cars as $car)
<div class="col-md-4 mb-3">
    <div class="card">
        @if($car->image)
            <img src="{{ asset('storage/'.$car->image) }}" class="card-img-top">
        @endif
        <div class="card-body">
            <h5>{{ $car->brand }} {{ $car->model }}</h5>
            <p>€ {{ number_format($car->price,2) }}</p>
            <a href="{{ route('public.cars.show',$car) }}" class="btn btn-primary">Bekijk</a>
        </div>
    </div>
</div>
@endforeach
</div>
@endsection
