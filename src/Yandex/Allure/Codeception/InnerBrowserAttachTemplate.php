<?php
$printTable = function ($aarray) {
    $result = '';
    if ($aarray) {
        foreach ($aarray as $key => $value) {
            $printValue = '';
            if (is_array($value)) {
                foreach ($value as $val) {
                    $printValue .= is_array($val) ? json_encode($val, JSON_UNESCAPED_UNICODE) . "\n" : (string)$val . "\n";
                }
            } elseif (is_scalar($value) || is_null($value)) {
                $printValue = (string)$value;
            } else {
                $printValue = var_export($value, true);
            }
            $result .= '<tr><td nowrap>' . $key . ':</td><td colspan="2"><pre>' . $printValue . '</pre></td></tr>';
        }
    }
    return $result;
};
return '
<html>
        <head>
            <meta http-equiv="content-type" content="text/html; charset = UTF-8">
            <title>HTTP-Request</title>
            <link href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.6/styles/default.min.css" rel="stylesheet" crossorigin="anonymous">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
            <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.6/highlight.min.js" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"  crossorigin="anonymous"></script>

            <script>hljs.initHighlightingOnLoad();</script>

            <style>
            pre {
                    white-space: pre-wrap;
                    margin-bottom: 0rem;
                }
            </style>
        </head>
        <body>
<h2>REQUEST</h2>
        <table class="table table-sm table-hover">
            <tbody>
                <tr class="table-primary">
                    <th colspan="3">
                        <pre><code class="http"><b>' . $requestObject->getMethod() . '</b> ' . $requestObject->getUri() . '</code></pre>
                    </th>
                </tr>
                <tr>
                    <th nowrap>Body</th>
                    <td colspan="2">
                        <pre><code>' . htmlspecialchars($requestObject->getContent()) . '</code></pre>
                    </td>
                </tr>

                <tr>
                    <th colspan="3" nowrap>Parameters</th>
                </tr>
' . $printTable($requestObject->getParameters()) . '
                <tr>
                    <th colspan="3" nowrap>Files</th>
                </tr>
' . $printTable($requestObject->getFiles()) . '
                <tr>
                    <th colspan="3" nowrap>Server</th>
                </tr>
' . $printTable($requestObject->getServer()) . '
                <tr>
                    <th colspan="3">Cookies</th>
                </tr>
' . $printTable($requestObject->getCookies()) . '
            </tbody>
        </table>

<h2>RESPONSE</h2>
        <table class="table table-sm table-hover">
            <tbody>
            <tr class="table-primary">
                <th nowrap>Status code</th>
                <th colspan="2">' . $responseObject->getStatusCode() . '</th>
            </tr>
            <tr>
                <th colspan="3" nowrap>Headers</th>
            </tr>
' . $printTable($responseObject->getHeaders()) . '
            <tr>
                <th nowrap>Body</th>
                <td colspan="2">
                    <pre><code>' . htmlspecialchars($responseObject->getContent()) . '</code></pre>
                </td>
            </tr>
        </tbody>
        </table>
        </body>
        </html>
';
