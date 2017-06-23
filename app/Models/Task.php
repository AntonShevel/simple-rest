<?php

namespace SimpleRest\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Task
 * @package App
 *
 * @property string $description
 * @property string $priority
 */
class Task extends Model
{
    protected $hidden = ['updated_at'];

    protected $perPage = 10;

    protected $fillable = ['description', 'priority'];
}
