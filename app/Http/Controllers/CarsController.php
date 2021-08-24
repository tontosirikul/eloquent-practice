<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Rules\Uppercase;
use App\Http\Requests\CreateValidation;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware('auth',['except'=>['index','show']]);
    }
    
    public function index()
    {
        $cars = Car::all();

        // $cars = Car::chunk(2,function ($cars){
        //     foreach($cars as $car){
        //         print_r($car->name);
        //     }
        // });

        return view('cars.index',['cars'=> $cars]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateValidation $request)
    {
        // $car = new Car;
        // $car->name = $request->input('name');
        // $car->founded = $request->input('founded');
        // $car->description = $request->input('description');
        // $car->save();

        // check incoming data
        

        $request->validated();

        $newImageName = time().'-'.$request->name . '.'.$request->image->extension();
        $request->image->move(public_path('images'), $newImageName);
        // $request->validate([
        //     'name'=>'required|unique:cars',
        //     // 'name' => new Uppercase,
        //     'founded' =>'required|integer|min:0|max:2021',
        //     'description'=>'required'
        // ]);

        // If it's valid, it will procees.
        // If it's not valid, throw a ValidationException


        $car = Car::create([
            'image_path'=> $newImageName,
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'founded' => $request->input('founded'),
            'user_id' => auth()->user()->id,
        ]);

        return redirect('/cars');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $car = Car::find($id);
        return view('cars.show')->with('car',$car);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car = Car::find($id);
        return view('cars.edit')->with('car',$car);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateValidation $request, $id)
    {
        $request->validated();

        $newImageName = time().'-'.$request->name . '.'.$request->image->extension();
        $request->image->move(public_path('images'), $newImageName);

        $car = Car::where('id',$id)
        ->update([
            'image_path'=> $newImageName,
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'founded' => $request->input('founded')
        ]);
        return redirect('/cars');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $car = Car::find($id);
        $car->delete();
        return redirect('/cars');
    }
}
