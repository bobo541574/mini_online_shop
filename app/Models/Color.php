<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getNameAttribute()
    {
        return $this->{'name_' . session('locale')};
    }

    public function getTextColorAttribute()
    {
        if (preg_match("/#c/i", $this->color_code)) {
            return "#f2f2f2";
        } elseif (preg_match("/#e/i", $this->color_code)) {
            return "#232323";
        } elseif (preg_match("/#f/i", $this->color_code)) {
            return "#232323";
        } else {
            return "#f4f4f4";
        }
    }
}
