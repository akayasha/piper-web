<?php

return [
    'project_id' => env('GOOGLE_PROJECT_ID'),
    'key_file' => storage_path('app/google-credentials/service-account-v1.json'),
];

// return [
//     'key_file_path' => env('GOOGLE_KEY_FILE_PATH'),
//     'client_id' => env('GOOGLE_CLIENT_ID'),
//     'client_secret' => env('GOOGLE_CLIENT_SECRET'),
//     'redirect' => env('GOOGLE_REDIRECT_URI'),
// ]