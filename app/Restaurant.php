<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $table ="restaurants";
    protected $fillable = ['name', 'type', 'opening_hour', 'closing_hour', 'logo', 'description', 'address'];

    public function type(){
        return $this->belongsTo(Type::class);
    }
}
