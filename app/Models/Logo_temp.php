<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'foto'
    ];

    /**
     * Get the URL of the logo image
     *
     * @return string
     */
    public function getImageUrl()
    {
        return $this->foto ? asset('storage/' . $this->foto) : null;
    }
}
