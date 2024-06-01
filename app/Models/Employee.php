<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    public function insurancePolicy(): BelongsTo
    {
        return $this->belongsTo(InsurancePolicy::class);
    }
}
