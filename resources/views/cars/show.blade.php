@extends('layouts.app')

@section('content')
    <div class="m-auto w-4/5 py-24">
        <div class="text-center">
            <h1 class="text-5xl uppercase
             bold">
                {{$car->name}}
            </h1>
            <img class="w-8/12 " src={{asset('images/'.$car->image_path)}} alt="{{$car->name}}"/>
        </div>
        <div class="pt-10">
            <a href="{{ url()->previous() }}" class="border-b-2 pb-2 border-dotted italic text-gray-500">
                Back to cars &rarr;
            </a>

        </div>
        <div class="text-center py-10">
        <div class="m-auto">

            <span class="uppercase text-blue-500 font-bold text-xs italic">
                {{$car->founded}}
            </span>
            <p class="text-lg text-gray-700 py-6">
                {{$car->description}}
            </p>
            <p class="mb-4">
                Product types: 
               @forelse ($car->products as $product)
                   {{$product->name}}
               @empty
                   No car product description
               @endforelse
            </p>
            <table class="table-auto">
                <tr class="bg-blue-100">
                    <th class="w-1/2 border-4">
                        Model
                    </th>
                    <th class="w-1/2 border-4">
                        Engines
                    </th>
                    <th class="w-1/2 border-4">
                        Production Date
                    </th>
                </tr>
                @forelse ($car->CarModels as $model)
                    <tr>
                        <td class="w-1/4 border-4">
                            {{$model->model_name}}
                        </td>
                        <td class="w-1/4 border-4">
                            @foreach ($car->engines as $engine)
                                @if ($model->id == $engine->model_id)
                                    {{$engine->engine_name}}
                                @endif

                            @endforeach
                        </td>
                        <td class="w-1/4 border-4">
                            {{date('d-m-Y',strtotime($car->productionDate->created_at))}}
                        </td>
                    </tr>
                @empty
                    <p>No car models found</p>
                @endforelse
            </table>
            

            <hr class="mt-4 mb-8">

        </div>
    </div>
    </div>
    
@endsection