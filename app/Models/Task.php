<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected  $fillable = [
        'title',
        'description',
        'due_date',
        'status'
    ];

    /**
     * @param $value
     * @return string
     */
    public function getDueDateAttribute($value): string
    {
        return Carbon::parse($value)->format('Y-m-d');
    }

    /**
     * @param $value
     * @return Carbon
     */
    public function setDueDateAttribute($value): Carbon
    {
        return $this->attributes['due_date'] = Carbon::parse($value);
    }
}
