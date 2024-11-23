<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public const TABLE = 'tasks';

    public const ID = 'id';
    public const NAME = 'name';
    public const DUE_DATE = 'due_date';
    public const PROJECT_ID = 'project_id';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    protected $table = self::TABLE;

    protected $guarded = [
        self::ID,
    ];
}
