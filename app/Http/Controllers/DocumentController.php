<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Services\DocumentService;
use Illuminate\Contracts\View\View;

class DocumentController extends Controller
{
  protected string $onlyOfficeHost;
  public function __construct(protected DocumentService $service)
  {
    $this->onlyOfficeHost = config('only-office.host');
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
    $user_id = auth()->id();
    $host = $this->onlyOfficeHost;

    return view('content.document.show-document', compact('document', 'user_id', 'host'));
  }

  public function deleteDocument($id)
  {
    if ($this->service->delete($id))
      return back();

    return back()->withErrors(['error' => 'Something went wrong']);
  }
}
