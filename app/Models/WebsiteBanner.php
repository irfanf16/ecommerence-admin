<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\ApiModel;

class WebsiteBanner extends Model
{
    use HasFactory;
    use ApiModel;

    protected static $api_path = "api/admin/website/banners";
}