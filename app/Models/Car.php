<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';

    protected $primaryKey = 'id';

    protected $fillable = ['name','founded','description','image_path','user_id'];

    public function carmodels()
    {
        return $this->hasMany(CarModel::class);
    }

    public function engines()
    {
        // need 'engine' from 'car model'
        return $this->hasManyThrough(
                Engines::class,
                CarModel::class,
                'car_id', //Foreign key on CarModel table
                'model_id' //Foreign key on Engine table
            );
    }
    public function productionDate()
    {
        return $this->hasOneThrough(
            CarProductionDate::class,
            CarModel::class,
            'car_id',
            'model_id'
        );
    }
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
