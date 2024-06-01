<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class InsurancePolicy extends Model
{
    public function employee(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
