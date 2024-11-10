<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Users;
use App\Models\Product;

class Buy extends Model
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
    public function product()
    {
        return $this->belongsTo(Product::class, 'productID');
    }

   
}