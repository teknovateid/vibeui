<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Laravel Authentication Lines
    |--------------------------------------------------------------------------
    */
    'failed' => 'These credentials do not match our records.',
    'password' => 'The provided password is incorrect.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',

    /*
    |--------------------------------------------------------------------------
    | Page Titles & Descriptions
    |--------------------------------------------------------------------------
    */
    'titles' => [
        'login' => 'Log in to your account',
        'login_description' => 'Welcome back! Please enter your details.',
        'register' => 'Create an account',
        'register_description' => 'Enter your details below to create your account.',
        'forgot_password' => 'Forgot password?',
        'forgot_password_description' => 'Enter your email address and we will send you a link to reset your password.',
        'reset_password' => 'Reset password',
        'reset_password_description' => 'Please enter your new password below.',
        'confirm_password' => 'Confirm password',
        'confirm_password_description' => 'This is a secure area of the application. Please confirm your password before continuing.',
        'verify_email' => 'Verify email address',
        'verify_email_description' => 'Please verify your email address to continue.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Form Fields & Labels
    |--------------------------------------------------------------------------
    */
    'fields' => [
        'name' => 'Full Name',
        'name_placeholder' => 'John Doe',
        'email' => 'Email Address',
        'email_placeholder' => 'name@domain.com',
        'username' => 'Username',
        'username_placeholder' => 'your_username',
        'phone' => 'Phone Number',
        'phone_placeholder' => '1234567890',
        'password' => 'Password',
        'password_placeholder' => '••••••••',
        'password_confirmation' => 'Confirm Password',
        'new_password' => 'New Password',
        'confirm_new_password' => 'Confirm New Password',
        'current_password' => 'Current Password',

        // Multi-credential dynamic labels
        'email_or_username' => 'Email or Username',
        'email_or_phone' => 'Email or Phone Number',
        'username_or_phone' => 'Username or Phone Number',
        'all_credentials' => 'Email, Username, or Phone Number',
        'credentials' => 'Account Credentials',
        'credentials_placeholder' => 'Enter your credentials...',
    ],

    /*
    |--------------------------------------------------------------------------
    | Action Buttons & Statuses
    |--------------------------------------------------------------------------
    */
    'actions' => [
        'login' => 'Sign In',
        'logging_in' => 'Signing In...',
        'register' => 'Create Account',
        'registering' => 'Creating Account...',
        'send_reset_link' => 'Send Password Reset Link',
        'sending_link' => 'Sending Link...',
        'reset_password' => 'Reset Password',
        'saving' => 'Saving...',
        'confirm' => 'Confirm Password',
        'verifying' => 'Verifying...',
        'resend_verification' => 'Resend Verification Email',
        'sending' => 'Sending...',
        'logout' => 'Log Out',
    ],

    /*
    |--------------------------------------------------------------------------
    | Passkey (WebAuthn)
    |--------------------------------------------------------------------------
    */
    'passkey' => [
        'login_button' => 'Sign in with Passkey',
        'connecting' => 'Connecting Device...',
        'separator' => 'or with credentials',
        'failed_title' => 'Passkey Authentication Failed',
        'dev_mode_title' => 'Local Development Mode',
        'dev_mode_notice' => 'Passkeys (WebAuthn) require a domain name. During local development, please access via localhost instead of IP address 127.0.0.1.',
        'switch_to_localhost' => 'Switch to Localhost',
    ],

    /*
    |--------------------------------------------------------------------------
    | Navigation & Helper Links
    |--------------------------------------------------------------------------
    */
    'links' => [
        'remember_me' => 'Remember me on this device',
        'forgot_password' => 'Forgot password?',
        'already_registered' => 'Already have an account?',
        'dont_have_account' => "Don't have an account?",
        'sign_in_now' => 'Sign in now',
        'sign_up_now' => 'Sign up now',
        'back_to_login' => 'Back to sign in',
        'remember_password' => 'Remember your password?',
    ],

    /*
    |--------------------------------------------------------------------------
    | Messages & Notifications
    |--------------------------------------------------------------------------
    */
    'messages' => [
        'verification_sent' => 'A new verification link has been sent to the email address you provided during registration.',
        'verification_notice' => 'Before getting started, please verify your email address by clicking on the link we just emailed to you. If you didn\'t receive the email, we will gladly send you another.',
    ],

];
