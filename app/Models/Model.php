<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Model extends Eloquent
{
    use HasFactory;
    use SoftDeletes;

    public static $withoutAppends = false;

    public static $customAppends = [];

    protected $guarded = [];

    /**
     * Get the user that owns the Model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dibuatOleh(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id')->withTrashed();
    }

    /**
     * Get the user that owns the Model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function diupdateOleh(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by', 'id')->withTrashed();
    }

    /**
     * scope without appends.
     *
     * @param mixed $query
     * @return mixed
     */
    public function scopeWithoutAppends($query)
    {
        self::$withoutAppends = true;

        return $query;
    }

    /**
     * get array appends.
     *
     * @return array
     */
    protected function getArrayableAppends()
    {
        if (self::$withoutAppends) {
            $dataAppends = self::$customAppends;

            return $dataAppends;
        }

        return parent::getArrayableAppends();
    }

    /**
     * scope custom appends.
     *
     * @param mixed $query
     * @return mixed
     */
    public function scopeCustomAppends($query, $attr)
    {
        self::$customAppends = $attr;

        return $query;
    }
}
