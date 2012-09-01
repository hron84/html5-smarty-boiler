<!DOCTYPE html>
<html>
<head>
  <title>We're sorry, but something went wrong (500)</title>
  <style type="text/css">
    body { background-color: #fff; color: #666; text-align: center; font-family: arial, sans-serif; }
    div.dialog {
      width: 25em;
      padding: 0 4em;
      margin: 4em auto 0 auto;
      border: 1px solid #ccc;
      border-right-color: #999;
      border-bottom-color: #999;
    }
    h1 { font-size: 100%; color: #f00; line-height: 1.5em; }
  </style>
</head>

<body>
  <!-- This file lives in public/500.html -->
  <div class="dialog">
    <h1>We're sorry, but something went wrong.</h1>
    <p>We've been notified about this issue and we'll take a look at it shortly.</p>
  </div>
  {*if $request->env eq 'production'*}
  Exception caused: {$exception->getMessage()}<br/>

  Stack trace:
  <ul>
  {foreach array_reverse($exception->getTrace()) as $trace}
  <li>
    {$trace.file}:{$trace.line}:in
    {if $trace.class ne ''}
    {$trace.class}->{$trace.function}
    {else}
    {$trace.function}
    {/if}
  </li>
  {/foreach}
  <li>{$exception->getFile()}:{$exception->getLine()}
  {*/if*}
</body>
</html>
