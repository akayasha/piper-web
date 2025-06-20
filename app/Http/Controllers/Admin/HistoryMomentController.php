<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Google\Client;
use Google_Client;
use Google_Service_Drive;
use Google\Service\Drive;
use Google\Cloud\Storage\StorageClient;

use App\DataTables\HistoryMomentDataTable;

class HistoryMomentController extends Controller
{
    public $view = 'history-moment.';
    public $route = 'history-moments.';
    public $title = 'History Moments';

    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        View::share('route', $this->route);
        View::share('view', $this->view);
        View::share('title', $this->title);

        $this->client = new \Google_Client();
        $this->client->setClientId(config('google.client_id'));
        $this->client->setClientSecret(config('google.client_secret'));
        $this->client->setRedirectUri(config('google.redirect_uri'));
        $this->client->setScopes([\Google_Service_Drive::DRIVE]);

        $this->service = new \Google_Service_Drive($this->client);
    }

    /**
     * Mendapatkan daftar file dari Google Drive
     */
    public function index(HistoryMomentDataTable $dataTable, Request $request)
    {
        $credentialsPath = config('google.key_file');

        $client = new Google_Client();
        $client->setAuthConfig($credentialsPath);
        $client->addScope(Google_Service_Drive::DRIVE_READONLY);

        if ($request->session()->has('google_token')) {
            $client->setAccessToken($request->session()->get('google_token'));
        }

        if ($client) {
            $service = new Google_Service_Drive($client);
            $files = $service->files->listFiles([
                'fields' => 'files(id, name, mimeType)',
            ]);

            $fileCollection = collect($files->getFiles())->map(function ($file) {
                return [
                    'id' => $file->getId(),
                    'name' => $file->getName(),
                    'mimeType' => $file->getMimeType(),
                    'size' => $this->formatSize($file->getSize()),
                    'created_at' => $file->getCreatedTime(),
                    'updated_at' => $file->getModifiedTime(),
                ];
            });

            return $dataTable->with('fileCollection', $fileCollection)->render('history-moment.index');
        } else {
            $authUrl = $client->createAuthUrl();
            return redirect()->away($authUrl);
        }
    }

    private function formatSize($size)
    {
        if ($size >= 1048576) {
            return number_format($size / 1048576, 2) . ' MB';
        } elseif ($size >= 1024) {
            return number_format($size / 1024, 2) . ' KB';
        } else {
            return $size . ' Bytes';
        }
    }

    public function callback(Request $request)
    {
        $credentialsPath = config('google.key_file');
        $client = new Google_Client();
        $client->setAuthConfig($credentialsPath);
        $client->addScope(Google_Service_Drive::DRIVE_READONLY);
        $token = $client->fetchAccessTokenWithAuthCode($request->get('code'));
        if (isset($token['access_token'])) {
            $request->session()->put('google_token', $token);
            return redirect()->route('google-drive');
        } else {
            return 'Authentication failed';
        }
    }

    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
