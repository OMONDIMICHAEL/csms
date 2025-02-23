<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procurement extends Model
{
  use HasFactory;

  protected $fillable = ['department', 'item_name', 'quantity', 'cost_per_unit', 'total_cost', 'status', 'budget_id'];

  public function budget()
  {
      return $this->belongsTo(Budget::class);
  }
}
