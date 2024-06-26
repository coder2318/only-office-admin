<?php

namespace App\Http\Controllers;

use App\Models\DocumentHistory;
use Illuminate\Http\Request;

class DocumentHistoryController extends Controller
{
  public function index(Request $request)
  {
    $history = DocumentHistory::query();
    if ($request->has('document_id'))
      $history->where('document_id', $request->get('document_id'));
    $history = $history->get();

    return view('content.document-history.index', compact('history'));
  }
}
