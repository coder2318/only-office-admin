<?php

namespace App\Traits;

use App\Models\Document;
use Firebase\JWT\JWT;

trait GetPayloadTrait
{

  protected string $secretToken;
  protected string $algorithm;

  public function generatePayload(Document $document): array
  {
    $payload = [
      'document' => [
        'info' => [
          'uploaded' => now()
        ],
        'fileType' => 'docx',
        'key' => uniqid(),
        'title' => $document->name,
        'url' => asset($document->path . '/' . $document->name),
        'permissions' => [
          'download',
          'edit',
          'print'
        ]
      ],
      'documentType' => 'text',
      'editorConfig' => [
        'mode' => 'edit',
        'callbackUrl' => route('document.save', ['id' => $document->id]),
        'user' => [
          'id' => auth()->id(),
          'name' => auth()->user()->name,
        ],
        'customization' => [
          "autosave" => true,
          'close' => [
            'visible' => true,
            'text' => 'Close file'
          ]
        ]
      ],
      'events' => [
        'onOutdatedVersion' => 'onOutdatedVersion',
        'onRequestClose' => 'onRequestClose',
      ],
      "height" => "100%",
      "width" => "100%"
    ];

    $token = JWT::encode($payload, $this->secretToken, $this->algorithm);

    return [
      'document' => $payload['document'],
      'documentType' => $payload['documentType'],
      'editorConfig' => $payload['editorConfig'],
      'events' => $payload['events'],
      'token' => $token
    ];
  }
}
