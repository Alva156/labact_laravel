<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Users;
use App\Models\Tickets;

class Book extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'fullname',
        'address',
        'number',
        'quantity',
        
    ];


    public function user(){
        return $this->hasOne(User::class, 'id' , 'user_id');
    }
    public function tickets()
    {
        return $this->belongsTo(Tickets::class, 'ticketID');
    }
   
}