<?php

namespace App\Observers;

use App\Models\Document;
use App\Models\DocumentHistory;

class DocumentObserver
{
    /**
     * Handle the Document "created" event.
     */
    public function created(Document $document): void
    {
        $this->storeDocumentHistory($document, 'create');
    }

    /**
     * Handle the Document "updated" event.
     */
    public function updated(Document $document): void
    {
    }

    /**
     * Handle the Document "deleted" event.
     */
    public function deleted(Document $document): void
    {
      $this->storeDocumentHistory($document, 'delete');
    }

    /**
     * Handle the Document "restored" event.
     */
    public function restored(Document $document): void
    {
        //
    }

    /**
     * Handle the Document "force deleted" event.
     */
    public function forceDeleted(Document $document): void
    {
        //
    }

    public function storeDocumentHistory(Document $document, $action): void
    {
      DocumentHistory::query()->create([
        'user_id' => auth()->id(),
        'document_id' => $document->id,
        'action' => $action,
      ]);
    }
}
