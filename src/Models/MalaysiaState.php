<?php

namespace Bersian\MalaysiaState\Models;

use Illuminate\Database\Eloquent\Model;

class MalaysiaState extends Model
{
    protected $table = 'malaysia_states';

    protected $fillable = ['location', 'post_office', 'post_ode', 'state'];
}
