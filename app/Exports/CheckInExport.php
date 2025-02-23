<?php

namespace App\Exports;

use App\Models\CheckIn;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CheckInExport implements FromQuery, WithHeadings
{
  use Exportable;

  protected $role, $name, $date;

  public function __construct($role, $name, $date)
  {
      $this->role = $role;
      $this->name = $name;
      $this->date = $date;
  }

  public function query()
  {
      $query = CheckIn::query()->with('user');

      if ($this->role) {
          $query->whereHas('user', function ($q) {
              $q->where('role', $this->role);
          });
      }

      if ($this->name) {
          $query->whereHas('user', function ($q) {
              $q->where('name', 'LIKE', '%' . $this->name . '%');
          });
      }

      if ($this->date) {
          $query->whereDate('check_in_time', $this->date);
      }

      return $query->select('id', 'user_id', 'name', 'check_in_time', 'check_out_time');
  }

  public function headings(): array
  {
      return ["ID", "User ID", "Name", "Check-In Time", "Check-Out Time"];
  }
}
