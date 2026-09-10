<?php

return [
    'filepond_pill' => 'View FilePond Payload',
    'controller_pill' => 'View Controller Payload',
    'filepond_success_title' => 'Files & Form Successfully Posted',
    'filepond_success_desc' => 'Form data was successfully received by <code class="px-1.5 py-0.5 rounded bg-muted text-[11px] font-mono text-foreground font-semibold">FilepondController::requestTest()</code> via <code class="px-1.5 py-0.5 rounded bg-muted text-[11px] font-mono text-foreground font-semibold">$request->all()</code> without reloading the page.',
    'form_success_title' => 'Form Successfully Posted (Controller Test)',
    'form_success_desc' => 'Form data was successfully received by <code class="px-1.5 py-0.5 rounded bg-muted text-[11px] font-mono text-foreground font-semibold">FormController::store()</code> via <code class="px-1.5 py-0.5 rounded bg-muted text-[11px] font-mono text-foreground font-semibold">$request->all()</code> without reloading the page.',
    'empty_title' => 'No form data submitted yet.',
    'filepond_empty_desc' => 'Upload files in any documentation test form and click submit to view <code class="font-mono text-xs">$request->all()</code> live in real-time.',
    'form_empty_desc' => 'Fill in the test form on this documentation page and click submit to view <code class="font-mono text-xs">$request->all()</code> live in real-time.',
    'tabs' => [
        'summary' => 'File Summary',
        'json' => 'JSON Payload',
        'table' => 'Key-Value Table',
    ],
    'copy_json' => 'Copy JSON',
    'copied' => 'Copied!',
    'copy' => 'Copy',
    'filepond_flow_success_title' => 'FilePond Client-to-Controller Flow Succeeded',
    'filepond_flow_success_desc' => 'FilePond injected the cloud storage key (S3 / Object Key) or server ID into hidden form inputs. Upon submission, the controller receives this key directly in <code class="font-mono text-[10px] bg-background/50 px-1 py-0.5 rounded">$request->all()</code> for database persistence.',
    'table_columns' => [
        'field' => 'Field (Key)',
        'value' => 'Value',
        'type' => 'Data Type',
    ],
    'csrf_valid' => '(Valid CSRF Token)',
    'null_empty' => 'null / empty',
    'response_time' => 'Response time:',
    'close_modal' => 'Close Modal',
];
