<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
      overflow: hidden;
    }
    #placeholder {
      height: 100%;
      width: 100%;
    }
  </style>
</head>
<body>

<div id="placeholder"></div>
<script type="text/javascript" src="{{$host}}/web-apps/apps/api/documents/api.js"></script>
<script type="text/javascript">

  const d = new Date();
  let time = d.getTime();
  const onOutdatedVersion = function() {
    location.reload(true);
  };
  const onRequestClose = function() {
    if (window.opener) {
      window.close();
      return;
    }
    docEditor.destroyEditor();
    window.location.href = "{{route('document.index')}}"
  };

  let docEditor = new DocsAPI.DocEditor('placeholder', {
    document: @json($payload['document']),
    documentType: @json($payload['documentType']),
    editorConfig: @json($payload['editorConfig']),
    events: {
      onOutdatedVersion: onOutdatedVersion,
      onRequestClose: onRequestClose
    },
    token: "{{ $payload['token'] }}"
  });

</script>

</body>
</html>
