<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Facades\Auth;
use App\Models\Tag;
use Illuminate\Support\Facades\Http;

class CarController extends Controller
{

    public function index()
    {
        $cars = Auth::user()->cars()->latest()->get();
        return view('cars.index', compact('cars'));
    }

    // ⭐ EDIT PAGINA
    public function edit(Car $car)
{
    if ($car->user_id !== auth()->id()) {
        abort(403);
    }

    $tags = Tag::all();

    return view('cars.edit', compact('car','tags'));
}

    // ⭐ UPDATE OPSLAAN
    public function update(Request $request, Car $car)
{
    if ($car->user_id !== auth()->id()) {
        abort(403);
    }

    $request->validate([
        'brand' => 'required|string|max:50',
        'model' => 'required|string|max:50',
        'year' => 'required|integer',
        'color' => 'nullable|string|max:50',
        'mileage' => 'nullable|integer|min:0',
        'price' => 'required|numeric|min:0',
        'tags' => 'nullable|array'
    ]);

    $car->update($request->only([
        'brand',
        'model',
        'year',
        'color',
        'mileage',
        'price'
    ]));

    // ⭐ TAGS OPSLAAN
    if ($request->tags) {
        $car->tags()->sync($request->tags);
    } else {
        $car->tags()->detach();
    }

    return redirect()->route('cars.index')
        ->with('success','Auto bijgewerkt!');
}

    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('cars.index');
    }

    public function toggleStatus(Car $car)
    {
        $car->is_sold = !$car->is_sold;
        $car->save();

        return back();
    }

    public function updatePrice(Request $request, Car $car)
    {
        $request->validate([
            'price' => 'required|numeric'
        ]);

        $car->update(['price'=>$request->price]);

        return back();
    }

    public function publicIndex(Request $request)
{
    $cars = Car::with('tags')
        ->latest()
        ->when($request->search, function ($query) use ($request) {
            $query->where('brand', 'like', '%' . $request->search . '%');
        })
        ->when($request->tag, function ($query) use ($request) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('tags.id', $request->tag);
            });
        })
        ->paginate(12);

    $tags = Tag::all();

    return view('public.index', compact('cars','tags'));
}

    public function otherCars()
    {
        $userId = auth()->check() ? auth()->id() : 0;

        $cars = Car::latest()
            ->when($userId,function($q) use($userId){
                $q->where('user_id','!=',$userId);
            })
            ->paginate(12);

        return view('cars.other', compact('cars'));
    }

    public function publicShow(Car $car)
    {
        $car->increment('views');
        return view('public.show', compact('car'));
    }

    // STEP 1
    public function createStep1()
    {
        return view('cars.create.step1');
    }

    public function postStep1(Request $request)
    {
        $licensePlate = strtoupper(str_replace('-', '', $request->license_plate));
        session(['car.license_plate'=>$licensePlate]);

        $response = Http::get('https://opendata.rdw.nl/resource/m9d7-ebf2.json',[
            'kenteken'=>$licensePlate
        ]);

        $data = $response->json();

        if(!empty($data[0])){
            $vehicle = $data[0];

            session(['car.details'=>[
                'brand'=>$vehicle['merk'] ?? '',
                'model'=>$vehicle['handelsbenaming'] ?? '',
                'year'=>$vehicle['bouwjaar'] ?? '',
                'color'=>$vehicle['eerste_kleur'] ?? '',
                'mileage'=>null,
                'price'=>null
            ]]);
        }

        return redirect()->route('cars.create.step2');
    }

    // STEP 2
    public function createStep2()
    {
        return view('cars.create.step2');
    }

    public function postStep2(Request $request)
    {
        session(['car.details'=>$request->only([
            'brand','model','year','color','mileage','price'
        ])]);

        return redirect()->route('cars.create.step3');
    }

    // STEP 3
    public function createStep3()
    {
        $tags = Tag::all();
        return view('cars.create.step3', compact('tags'));
    }

    public function store(Request $request)
    {
        $details = session('car.details');
        $plate = session('car.license_plate');

        $car = Car::create([
            'user_id'=>auth()->id(),
            'license_plate'=>$plate,
            'brand'=>$details['brand'],
            'model'=>$details['model'],
            'year'=>$details['year'],
            'color'=>$details['color'],
            'mileage'=>$details['mileage'],
            'price'=>$details['price'],
            'is_sold'=>false
        ]);

        if($request->tags){
            $car->tags()->sync($request->tags);
        }

        session()->forget('car');

        return redirect()->route('cars.index');
    }

}
