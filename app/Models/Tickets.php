<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Users;

class Tickets extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'first_team',
        'second_team',
        'date',
        'time',
        'price',
        
    ];


    public function user(){
        return $this->hasOne(User::class, 'id' , 'user_id');
    }
}