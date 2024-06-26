<?php

namespace App\Services;

use App\Models\Document;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class DocumentService
{

  public function get(): Collection|array
  {
    return Document::query()->with('document_history', 'document_history.user')->orderBy('id', 'desc')->get();
  }

  public function delete($id): bool
  {
    $document = $this->getById($id);
    return $document->delete();
  }

  public function getById(int $id): Builder|array|Collection|Model
  {
    return Document::query()->findOrFail($id);
  }

}
