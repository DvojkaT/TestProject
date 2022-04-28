<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property string $name
 * @property-read Collection|User[] $workers
 */
class Department extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
      'name',
    ];

    public function workers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(User::class, 'department_id', 'id');
    }
}
