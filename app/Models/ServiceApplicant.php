<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceApplicant extends Model
{
  use HasFactory, Notifiable;
  protected $guarded = ['id'];

  public function service()
  {
      return $this->belongsTo(Service::class, 'service_id');
  }

  public function list()
  {
      return $this->belongsTo(ListService::class, 'list_id');
  }
}
