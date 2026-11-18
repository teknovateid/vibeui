<?php

return [
    'confirm_title' => 'Confirmation',
    'confirm_btn' => 'Confirm',
    'error_title' => 'An Error Occurred',
    'notice_title' => 'Notice',
    'passkey' => [
        'default_device' => 'My Device',
        'ip_address_notice' => 'WebAuthn (Passkey) requires a valid domain name. During local development, please use localhost instead of IP address 127.0.0.1 (e.g. :url).',
        'invalid_domain' => 'Invalid domain for Passkey. Please use :url',
        'auth_cancelled' => 'No Passkey is registered on this device for this application yet, or the authentication prompt was cancelled. Please sign in with your password first and register a Passkey.',
        'verify_failed' => 'Failed to verify passkey.',
        'register_cancelled' => 'Passkey registration was cancelled by user.',
        'sudo_required' => 'Password confirmation (sudo mode) is required before registering a new Passkey.',
        'register_failed' => 'Failed to register passkey.',
        'verify_error' => 'An error occurred while verifying passkey.',
        'not_loaded' => 'Passkey module is not loaded yet.',
        'confirm_failed' => 'Failed to confirm with passkey.',
    ],
];
