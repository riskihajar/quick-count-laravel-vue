<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $casts = [
        'zakat' => 'double',
        'infaq' => 'double',
        'jumlah' => 'double'
    ];
    protected $fillable = ['nama', 'zakat', 'infaq', 'jumlah'];
    public $timestamps = false;

}
