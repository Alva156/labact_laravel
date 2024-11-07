<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Users;


class History extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'era',
        'year',
        'description',
        
        
    ];


    public function user(){
        return $this->hasOne(User::class, 'id' , 'user_id');
    }
   
}