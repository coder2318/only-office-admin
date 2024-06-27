<?php

namespace App\Http\Controllers;

use App\Http\Requests\OnlyOffice\CreateRequest;
use App\Models\Document;
use App\Services\OnlyOfficeService;
use App\Traits\GetPayloadTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class OnlyOfficeController extends Controller
{
  use GetPayloadTrait;
  protected string $onlyOfficeHost;
  public function __construct(protected OnlyOfficeService $service)
  {
    $this->service->documentStoragePath = storage_path('app/public/documents');
    $this->service->documentAbsolutePath = 'storage/documents';
    $this->onlyOfficeHost = config('only-office.host');
    $this->secretToken = config('only-office.secretToken');
    $this->algorithm = config('only-office.algorithm');
  }

  public function createDocument(CreateRequest $request): View
  {
    $document = $this->service->create($request->input('filename'));
    $host = $this->onlyOfficeHost;
    $payload = $this->generatePayload($document);

    return view('content.document.show-document', compact('payload', 'host'));
  }

  public function saveDocument(Request $request): void
  {
    $this->service->save($request);
  }


}
