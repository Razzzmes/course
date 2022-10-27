<?php

namespace App\Models;

use App\Models\Message;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category_id',
    ];

    public function category() {
        return $this->BelongsTo(Category::class);
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }

}
