<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = ['module_id', 'uuid', 'name', 'video', 'description'];

    public function modules(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Module::class);
    }
}
