<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    public const TABLE = 'projects';

    public const ID = 'id';
    public const NAME = 'name';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    protected $table = self::TABLE;

    protected $guarded = [
        self::ID,
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, Task::PROJECT_ID, self::ID);
    }
}
