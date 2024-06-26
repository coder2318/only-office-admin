<?php

namespace App\Services;

use App\Models\Document;
use App\Models\DocumentHistory;
use Illuminate\Support\Facades\File;

class OnlyOfficeService
{

  public string $documentStoragePath;
  public string $documentAbsolutePath;

  public function create(string $name): Document
  {
    $filename = $name . '.docx';
    $filePath = $this->documentStoragePath . '/' . $filename;

    $this->createEmptyDocument($filePath);

    $documentKey = md5($filename . time());

    /** @var Document $document */
    $document = Document::query()->create([
      'name' => $filename,
      'path' => $this->documentAbsolutePath,
      'key' => $documentKey,
    ]);
    return $document;
  }

  protected function createEmptyDocument(string $filePath): void
  {
    $content = ""; // Empty content for new document
    if (!File::exists($this->documentStoragePath))
      File::makeDirectory($this->documentStoragePath);
    file_put_contents($filePath, $content);
  }

  public function save($request): void
  {
    if (($body_stream = file_get_contents("php://input")) === FALSE) {
      echo "Bad Request";
    }

    $data = json_decode($body_stream, TRUE);

    if ($data["status"] == 2) {
      $downloadUri = $data["url"];

      if (($new_data = file_get_contents($downloadUri)) === FALSE)
        echo "Bad Response";
      else {

        /** @var Document $document */
        $document = Document::query()->findOrFail($request->id);

        file_put_contents($this->documentStoragePath . '/' . $document->name, $new_data, LOCK_EX);

        $document->update(['updated_at' => now()]);

        DocumentHistory::query()->create([
          'user_id' => $request->actions[0]['userid'],
          'document_id' => $document->id,
          'action' => 'update'
        ]);

      }
    }
    echo "{\"error\":0}";
  }
}
