<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfileDesa extends Model

{
    use HasFactory;
    protected $fillable = [
        'content_misi',
        'content_visi',
        'alamat',
        'about_us',
        'sejarah',
        'yt_link',
        'fb_link',
        'wa_link',
        'ig_link'
    ];

    static function getData()
    {
        return DB::table('profile_desas')->first();
    }
}
