<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [ 'title', 'slug', 'content' ];

   public function categorie()
   {
       return $this->belongsTo(Categorie::class);
   }

    public function tags()
    {
         return $this->belongsToMany(Tag::class);
    }
}
