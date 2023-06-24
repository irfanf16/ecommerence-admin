<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\ApiModel;

class Order extends Model
{
    use HasFactory;
    use ApiModel;

    protected static $api_path = "api/admin/order";

}