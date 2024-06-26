<?php

namespace App\Http\Controllers;

use App\Http\Requests\OnlyOffice\CreateRequest;
use App\Services\OnlyOfficeService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class OnlyOfficeController extends Controller
{

  protected string $onlyOfficeHost;
  public function __construct(protected OnlyOfficeService $service)
  {
    $this->service->documentStoragePath = storage_path('app/public/documents');
    $this->service->documentAbsolutePath = 'storage/documents';
    $this->onlyOfficeHost = config('only-office.host');
  }

  public function createDocument(CreateRequest $request): View
  {
    $document = $this->service->create($request->input('filename'));
    $user_id = auth()->id();
    return view('content.document.show-document', with(['document' => $document, 'user_id' => $user_id, 'host' => $this->onlyOfficeHost]));
  }

  public function saveDocument(Request $request): void
  {
    $this->service->save($request);
  }


}
