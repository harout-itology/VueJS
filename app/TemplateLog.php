<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplateLog extends Model
{

	protected $guarded = [];


    public function template()
    {
        return $this
            ->belongsTo(Template::class, 'template_id');
    }

}
