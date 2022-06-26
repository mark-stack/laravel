<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Project extends Authenticatable
{

    protected $table = 'projects';

    protected $primaryKey = 'id';

    protected $guarded = ['id'];

}
