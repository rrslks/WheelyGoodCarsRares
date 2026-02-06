@extends('layouts.app')
@section('content')
<div class="container">
    {{-- Progressbar --}}
<div class="progress mb-4">
    <div class="progress-bar bg-primary" role="progressbar" style="width: 100%">
        Stap 3/3
    </div>
</div>

    <h2 class="mb-4">Stap 3: Kies tags</h2>

    <form action="{{ route('cars.store') }}" method="POST">
        @csrf
        <div class="row">
            @foreach($tags as $tag)
                <div class="col-md-3 col-sm-4 col-6 mb-2">
                    <div class="form-check card p-2 text-center border">
                        <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}" id="tag{{ $tag->id }}">
                        <label class="form-check-label" for="tag{{ $tag->id }}">{{ $tag->name }}</label>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-success mt-3">Opslaan</button> {{-- type="submit" is cruciaal --}}
    </form>
</div>
@endsection
