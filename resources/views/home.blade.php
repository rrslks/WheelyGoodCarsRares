@extends('layouts.app')
@section('content')
<div class="text-center">
    <h1>Welkom bij Wheely Good Cars</h1>
    <p class="lead mt-3">Koop en verkoop eenvoudig tweedehands auto's</p>
    <a href="{{ route('public.cars.index') }}" class="btn btn-dark btn-lg mt-4">Bekijk aanbod</a>
</div>
@endsection
