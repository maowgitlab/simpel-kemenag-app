<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserDetail extends Model
{
  use HasFactory, Notifiable;
  protected $guarded = ['id'];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
