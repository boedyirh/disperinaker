<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ak1SlotModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_slot';
    protected $primaryKey = 'slot_id';
    protected $guarded = ['slot_id'];
}
