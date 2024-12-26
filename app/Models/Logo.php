<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'foto',
        'foto_thumb',
        'foto_medium',
        'foto_large'
    ];

    /**
     * Get the URL of the logo image
     *
     * @return string
     */
    public function getImageUrl($size = 'original')
    {
        switch ($size) {
            case 'thumb':
                return $this->foto_thumb ? asset('storage/' . $this->foto_thumb) : null;
            case 'medium':
                return $this->foto_medium ? asset('storage/' . $this->foto_medium) : null;
            case 'large':
                return $this->foto_large ? asset('storage/' . $this->foto_large) : null;
            default:
                return $this->foto ? asset('storage/' . $this->foto) : null;
        }
    }
}
