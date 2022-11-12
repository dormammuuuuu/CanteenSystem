<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\FoodItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FoodController extends Controller
{
    protected $rules = [
        'name' => 'required|string',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'images' => 'required',
    ];

    public function read(){
        return FoodItem::where('owner', auth()->user()->id)->get();
    }

    public function store(Request $request){
        $tmp = $request->validate($this->rules);

        $names = [];
        foreach($request->images as $image){
            $from = public_path('tmp/uploads/'.$image['name']);
            $to = public_path('img/upload/'.$image['name']);
            $filename = $image['name'];
            File::move($from, $to);
            array_push($names, $filename);       
        }

        $data = [
            'name' => $tmp['name'],
            'description' => $tmp['description'],
            'price' => $tmp['price'],
            'owner' => auth()->user()->id,
            'image' => json_encode($names),
        ];
       
        FoodItem::create($data);

        session()->flash('flash.banner', 'Food added successfully!');
        session()->flash('flash.bannerStyle', 'success');

        return response()->json(['success' => true]);
    }

    public function listings() {
        $data = [
            'listings' => FoodItem::where('owner', auth()->user()->id)->get(),
        ];
        return Inertia::render('Listings', $data);
    }
}
