<?php

namespace App\Models;

use App\Models\Concerns\AsTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory, AsTenant;
}
