<?php

namespace App;

use App\Traits\ApiModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use ApiModel;

    protected static $api_path = "api/admin/categories";


}