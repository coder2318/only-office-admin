<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Services\DocumentService;
use App\Traits\GetPayloadTrait;
use Illuminate\Contracts\View\View;

class DocumentController extends Controller
{
  use GetPayloadTrait;
  protected string $onlyOfficeHost;
  public function __construct(protected DocumentService $service)
  {
    $this->onlyOfficeHost = config('only-office.host');
    $this->secretToken = config('only-office.secretToken');
    $this->algorithm = config('only-office.algorithm');
  }

  public function index(): View
  {
    $documents = $this->service->get();
    return view('content.document.index', compact('documents'));
  }

  public function showDocument($id): View
  {
    /** @var Document $document */
    $document = $this->service->getById($id);
    $host = $this->onlyOfficeHost;
    $payload = $this->generatePayload($document);

    return view('content.document.show-document', compact('payload', 'host'));
  }

  public function deleteDocument($id)
  {
    if ($this->service->delete($id))
      return back();

    return back()->withErrors(['error' => 'Something went wrong']);
  }
}
