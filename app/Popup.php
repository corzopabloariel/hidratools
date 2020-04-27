<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Popup extends Model
{
    protected $fillable = [
        "section",
        "image",
        "active",
        "elim"
    ];
    protected $casts = [
        "section" => "string",
        "image" => "array",
        "active" => "boolean",
        "elim" => "boolean"
    ];
}
