<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image_preview_id',
        'category_id',
        'prize',
        'description',
        'size',
    ];


    public function getImagePath(): string
    {
        $img = Image::find($this->getAttribute('image_preview_id'));
        return  $img->path;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(category::class);
    }

    public function image(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(image::class,'image_preview_id');
    }
}
