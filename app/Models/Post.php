<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    const STATE_DRAFT = 'draft';

    protected $fillable = [
        'title',
        'state',
        'short_content',
        'content',
        'image',
        'url_key',
        'meta_description',
        'meta_keywords',
    ];

    public function save(array $options = []){
        
        if(!$this->url_key){
            $this->url_key = Str::slug($this->title); 
        }

        return parent::save($options);
    }

}
