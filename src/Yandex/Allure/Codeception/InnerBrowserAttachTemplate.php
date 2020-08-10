<?php
$formatForOutput = function ($output) {
    $formatOutput = '';
    if (is_array($output)) {
        foreach ($output as $key => $value) {
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
            $formatOutput .= '<tr><td nowrap>' . $key . ':</td><td colspan="2"><pre>' . $printValue . '</pre></td></tr>';
        }
    } elseif (is_scalar($output)) {
        $formatOutput = (string)$output;
    } elseif ($output) {
        $formatOutput = var_export($output, true);
    }
    return $formatOutput;
};

if (!$responseObject) {
    return 'Error. $responseObject not set!';
}

$requestMethod = method_exists($requestObject, 'getMethod') ? $requestObject->getMethod() : 'Error. Method "getMethod" not exist!';
$requestUri = method_exists($requestObject, 'getUri') ? $requestObject->getUri() : 'Error. Method "getUri" not exist!';
if (method_exists($responseObject, 'getStatusCode')) {
    $responseStatusCode = $responseObject->getStatusCode();
} elseif (method_exists($responseObject, 'getStatus')) {
    $responseStatusCode = $responseObject->getStatus();
} else {
    $responseStatusCode = 'Error. Method "getStatusCode" and "getStatus" not exist!';
}
$requestContent = method_exists($requestObject, 'getContent') ? htmlspecialchars($requestObject->getContent()) : 'Error. Method "getContent" not exist!';
$requestParams = method_exists($requestObject, 'getParameters') ? $requestObject->getParameters() : 'Error. Method "getParameters" not exist!';
$requestFiles = method_exists($requestObject, 'getFiles') ? $requestObject->getFiles() : 'Error. Method "getFiles" not exist!';
$requestServer = method_exists($requestObject, 'getServer') ? $requestObject->getServer() : 'Error. Method "getServer" not exist!';
$requestCookies = method_exists($requestObject, 'getCookies') ? $requestObject->getCookies() : 'Error. Method "getCookies" not exist!';
$responseHeaders = method_exists($responseObject, 'getHeaders') ? $responseObject->getHeaders() : 'Error. Method "getHeaders" not exist!';
$responseContent = method_exists($responseObject, 'getContent') ? htmlspecialchars($responseObject->getContent()) : 'Error. Method "getContent" not exist!';


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
                        <pre><code class="http"><b>' . $requestMethod . '</b> ' . $requestUri . '</code></pre>
                    </th>
                </tr>
                <tr>
                    <th nowrap>Body</th>
                    <td colspan="2">
                        <pre><code>' . $requestContent . '</code></pre>
                    </td>
                </tr>

                <tr>
                    <th colspan="3" nowrap>Parameters</th>
                </tr>
' . $formatForOutput($requestParams) . '
                <tr>
                    <th colspan="3" nowrap>Files</th>
                </tr>
' . $formatForOutput($requestFiles) . '
                <tr>
                    <th colspan="3" nowrap>Server</th>
                </tr>
' . $formatForOutput($requestServer) . '
                <tr>
                    <th colspan="3">Cookies</th>
                </tr>
' . $formatForOutput($requestCookies) . '
            </tbody>
        </table>

<h2>RESPONSE</h2>
        <table class="table table-sm table-hover">
            <tbody>
            <tr class="table-primary">
                <th nowrap>Status code</th>
                <th colspan="2">' . $responseStatusCode . '</th>
            </tr>
            <tr>
                <th colspan="3" nowrap>Headers</th>
            </tr>
' . $formatForOutput($responseHeaders) . '
            <tr>
                <th nowrap>Body</th>
                <td colspan="2">
                    <pre><code>' . $responseContent . '</code></pre>
                </td>
            </tr>
        </tbody>
        </table>
        </body>
        </html>
';
