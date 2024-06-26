<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property int $document_id
 * @property string $action
 */
class DocumentHistory extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'document_id',
    'action'
  ];

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }

  public function document(): BelongsTo
  {
    return $this->belongsTo(Document::class, 'document_id', 'id');
  }
}
