<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsLetter extends Model
{
    use HasFactory;
    
    protected $table='newsletter';
    protected $fillable=[
        'name',
        'email',
       
                   
        


    ];
}
