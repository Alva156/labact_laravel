<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Users;


class Opinion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'content'
        
        
    ];


    public function user(){
        return $this->hasOne(User::class, 'id' , 'user_id');
    }
   
}