<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    public static   $level      = 1;
    public static   $delay      = 3;

    public function children()
    {
        return $this
            ->hasMany(Self::class, 'parent_id');
    }

    public function log()
    {
        return $this
            ->hasMany(TemplateLog::class, 'template_id');
    }

}

