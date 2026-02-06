@extends('layouts.app')

@section('content')
<h2>Publiek aanbod</h2>

<form method="GET" class="mb-4">

<div class="row">

<div class="col-md-5">
<input
    type="text"
    name="search"
    class="form-control"
    placeholder="Zoek op merk"
    value="{{ request('search') }}"
>
</div>

<div class="col-md-4">
<select name="tag" class="form-control">
    <option value="">-- Filter op tag --</option>

    @foreach($tags as $tag)
        <option value="{{ $tag->id }}"
            {{ request('tag') == $tag->id ? 'selected' : '' }}>
            {{ $tag->name }}
        </option>
    @endforeach

</select>
</div>

<div class="col-md-3">
<button class="btn btn-dark w-100">Zoeken / Filter</button>
</div>

</div>
</form>

<div class="row">

@foreach($cars as $car)

<div class="col-md-4 mb-3">
<div class="card h-100">
<div class="card-body">

@if($car->views >= 20)
<span class="badge bg-warning text-dark mb-1">⭐ Aanrader</span>
@endif

<span class="badge {{ $car->is_sold ? 'bg-danger' : 'bg-success' }}">
    {{ $car->is_sold ? 'Verkocht' : 'Te koop' }}
</span>

<h5>{{ $car->brand }} {{ $car->model }}</h5>

<p>Bouwjaar: {{ $car->year }}</p>
<p>Kilometers: {{ $car->mileage }}</p>
<p>Prijs: € {{ number_format($car->price,2) }}</p>
<p>Aangeboden door: {{ $car->user->name }}</p>

{{-- ⭐ TAGS TONEN --}}
<div class="mb-2">
@foreach($car->tags as $tag)
    <span class="badge bg-primary">{{ $tag->name }}</span>
@endforeach
</div>

@auth
<form method="POST" action="{{ route('favorites.toggle', $car) }}">
@csrf
<button class="btn btn-link p-0">
@if(auth()->user()->favorites->contains($car->id))
❤️
@else
🤍
@endif
</button>
</form>
@endauth

<a href="{{ route('public.cars.show', $car) }}" class="btn btn-primary mt-2">
Bekijk
</a>

</div>
</div>
</div>

@endforeach

</div>

<div class="mt-4">
{{ $cars->links() }}
</div>

@endsection
