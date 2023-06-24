<?php

namespace App;

use App\Traits\ApiModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\MockObject\Api;

class Brand extends Model
{
    use HasFactory;
    use ApiModel;

    protected static $api_path = "api/admin/brands";
}