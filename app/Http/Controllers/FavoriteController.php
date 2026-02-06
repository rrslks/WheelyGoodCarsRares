<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggle(Car $car)
    {
        $user = Auth::user();

        if ($user->favorites()->where('car_id', $car->id)->exists()) {
            $user->favorites()->detach($car->id);
        } else {
            $user->favorites()->attach($car->id);
        }

        return back();
    }

    public function index()
    {
        $cars = Auth::user()->favorites()->paginate(12);
        return view('favorites.index', compact('cars'));
    }
}
