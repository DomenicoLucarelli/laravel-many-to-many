<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;

    protected $fillable = ['title','type_id','description','image','date','git_url'];

    public function type(){
       return $this->belongsTo(Type::class);
    }
}
