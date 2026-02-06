@extends('layouts.app')

@section('content')
<h2>Mijn auto's</h2>

<div class="d-flex justify-content-between align-items-center mb-3">

<h2>Mijn auto's</h2>

<a href="{{ route('cars.create.step1') }}" class="btn btn-primary">
     Auto toevoegen
</a>

</div>

@foreach($cars as $car)

<div class="card mb-3">
    <div class="card-body">

        <h5>{{ $car->brand }} {{ $car->model }}</h5>
        <p>Prijs: €{{ $car->price }}</p>

        <span class="badge {{ $car->is_sold ? 'bg-danger' : 'bg-success' }}">
            {{ $car->is_sold ? 'Verkocht' : 'Te koop' }}
        </span>

        <div class="mt-2">

            <!-- ⭐ EDIT -->
            <a href="{{ route('cars.edit',$car) }}" class="btn btn-warning btn-sm">
                Bewerken
            </a>

            <form method="POST" action="{{ route('cars.toggleStatus',$car) }}" class="d-inline">
                @csrf
                @method('PATCH')
                <button class="btn btn-secondary btn-sm">Status wisselen</button>
            </form>

            <form method="POST" action="{{ route('cars.destroy',$car) }}" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">Verwijderen</button>
            </form>

        </div>

    </div>
</div>

@endforeach

@endsection
