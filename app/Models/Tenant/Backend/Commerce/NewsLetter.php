<?php

namespace App\Models\Tenant\Backend\Commerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsLetter extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table='newsletter';
    protected $fillable=[
        'name',
        'email',
       
                   
        


    ];
}
