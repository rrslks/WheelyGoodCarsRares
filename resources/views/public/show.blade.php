@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Auto details</h2>

    <p><strong>Kenteken:</strong> {{ $car->license_plate }}</p>
    <p><strong>Merk:</strong> {{ $car->brand }}</p>
    <p><strong>Model:</strong> {{ $car->model }}</p>
    <p><strong>Bouwjaar:</strong> {{ $car->year }}</p>
    <p><strong>Kleur:</strong> {{ $car->color }}</p>
    <p><strong>Kilometers:</strong> {{ $car->mileage }}</p>
    <p><strong>Vraagprijs:</strong> € {{ number_format($car->price, 2) }}</p>
    <p><strong>Status:</strong> {{ $car->is_sold ? 'Verkocht' : 'Te koop' }}</p>
    <p><strong>Aangeboden door:</strong> {{ $car->user->name }}</p>
    <p><strong>Aantal views:</strong> {{ $car->views }}</p>



    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Terug</a>
</div>
@endsection

{{-- Toast popup --}}
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="viewToast" class="toast align-items-center text-bg-dark border-0" role="alert">
        <div class="d-flex">
            <div class="toast-body">
                🔥 {{ $car->views }} klanten bekeken deze auto vandaag!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {

    setTimeout(function () {

        let toastElement = document.getElementById('viewToast');
        let toast = new bootstrap.Toast(toastElement);

        toast.show();

    }, 10000); // 10 seconden

});
</script>

