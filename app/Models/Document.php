<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $name
 * @property string $key
 * @property string $path
 */
class Document extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'user_id',
    'name',
    'key',
    'path',
    'updated_at'
  ];

  public static function boot()
  {
    parent::boot();
    self::creating(function ($model) {
        $model->user_id = auth()->id();
    });
  }

  public function document_history(): HasMany
  {
    return $this->hasMany(DocumentHistory::class, 'document_id', 'id');
  }
}
