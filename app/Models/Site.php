<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = ['team_id', 'url', 'search_query'];

    public function scan_results(): HasMany
    {
        return $this->hasMany(ScanResult::class);
    }

    public function last_scan_result(): HasOne
    {
        return $this->hasOne(ScanResult::class)->latest();
    }
}
