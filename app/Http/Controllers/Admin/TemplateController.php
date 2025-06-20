<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

// Library Installer
use RealRashid\SweetAlert\Facades\Alert;
    
// Models
use App\Models\Template;
use App\Models\Branch;

use App\DataTables\TemplateDataTable;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Promise;
use GuzzleHttp\Client;

// Helpers
use App\Helpers\Media;

class TemplateController extends Controller
{
    public $view = 'template.';
    public $route = 'templates.';
    public $title = 'Template';
    public $subtitle = 'List Data Template';
    public $model;

    public function __construct(Template $model)
    {
        View::share('route', $this->route);
        View::share('view', $this->view);
        View::share('title', $this->title);
        View::share('subtitle', $this->subtitle);
        $this->model = $model;
    }

    use Media;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, TemplateDataTable $dataTable)
    {
        $client = new Client(); 
        $url = "http://82.29.160.126:5001/load-templates-no64-by-branch?branch=" . $request->branch;

        try {
            Log::info("Sending async request to: $url");
            $promise = $client->getAsync($url, [
                'timeout' => 10, 
            ]);
            $response = $promise->wait(); 
            $statusCode = $response->getStatusCode();
            if ($statusCode == 200) {
                Log::info("Response received successfully with status code: $statusCode");
                $responseBody = json_decode($response->getBody()->getContents(), true);
                Log::info("Response Body: " . json_encode($responseBody));
                if ($responseBody) {
                    foreach ($responseBody['templates'] as $item) {
                        $template = $this->model->updateOrCreate(
                            ['name' => $item['name']],
                            [
                                'count_photo' => $item['count_photo'] ?? 0,
                                'branch' => $item['branch']
                            ]
                        );
                        Log::info("Template {$item['branch']} processed.");
                    }
                } else {
                    Log::error('Templates data is empty or not found in the response.');
                }
            } else {
                Log::error("Failed to receive valid response. Status Code: $statusCode");
            }
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            Log::error("Request failed. Error: " . $e->getMessage());
        } catch (\Exception $e) {
            Log::error("Error fetching templates data: " . $e->getMessage());
        }

        return $dataTable
        ->where('branch', $request->branch)
        ->render('branch.detail');
    }

    // DEV FUNCTION
    // public function index(Request $request, TemplateDataTable $dataTable)
    // {
    //     set_time_limit(300); 

    //     $client = new Client();
    //     $url = "http://82.29.160.126:5001/load-templates-by-branch?branch=" . $request->branch . "&limit=10";
    //     $success = false;
    
    //     try {
    //         Log::info("Sending async request to: $url");
    
    //         $promise = $client->getAsync($url, [
    //             'timeout' => 60,
    //             'connect_timeout' => 10,
    //             'stream' => true, 
    //         ]);
    
    //         $response = $promise->wait();
    //         $statusCode = $response->getStatusCode();
    
    //         if ($statusCode == 200) {
    //             Log::info("Response received successfully with status code: $statusCode");
    
    //             $body = $response->getBody();
    
    //             // Stream response body secara bertahap
    //             $responseContent = '';
    //             while (!$body->eof()) {
    //                 $responseContent .= $body->read(1024); // Membaca 1024 byte per iterasi
    //             }
    
    //             $responseBody = json_decode($responseContent, true);
    //             Log::info("Response Body: " . json_encode($responseBody));
    
    //             if (!empty($responseBody['templates'])) {
    //                 foreach ($responseBody['templates'] as $item) {
    //                     $this->model->updateOrCreate(
    //                         ['name' => $item['name']],
    //                         [
    //                             'count_photo' => $item['count_photo'] ?? 0,
    //                             'template' => $item['data'],
    //                             'branch' => $item['branch']
    //                         ]
    //                     );
    //                     Log::info("Template {$item['branch']} processed.");
    //                 }
    //                 $success = true;
    //             } else {
    //                 Log::error('Templates data is empty or not found in the response.');
    //             }
    //         } else {
    //             Log::error("Failed to receive valid response. Status Code: $statusCode");
    //         }
    //     } catch (\GuzzleHttp\Exception\RequestException $e) {
    //         Log::error("Request failed. Error: " . $e->getMessage());
    //     } catch (\Exception $e) {
    //         Log::error("Error fetching templates data: " . $e->getMessage());
    //     }
    
    //     // Jika AJAX request, kirim respons JSON
    //     if ($request->ajax()) {
    //         return response()->json(['success' => $success]);
    //     }
    
    //     return $dataTable
    //         ->where('branch', $request->branch)
    //         ->render('branch.detail');
    // }


    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $branch_data = Branch::where('id' , $id)->first();
        return view($this->view . 'create', compact('branch_data'));
    }

    /**
     * Store a newly created resource in storage.
     */

    
    public function store(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'template' => 'required|file',
        ]);
    
        $branch = Branch::find($id);
        if (!$branch) {
            Alert::error('Error', 'Branch not found.');
            return back();
        }

        $templateFile = $request->file('template');
        $filePath = $templateFile->store('templates');
        $data = [
            'template_name' => $request->input('name'),
            'template_file' => $templateFile, 
            'branch' => $branch->name,
        ];
    
        $client = new Client();
        try {
            $response = $client->post('http://82.29.160.126:5001/save-template', [
                'multipart' => [
                    [
                        'name'     => 'template_name',
                        'contents' => $data['template_name']
                    ],
                    [
                        'name'     => 'template_file',
                        'contents' => fopen($templateFile->getPathname(), 'r'),
                        'filename' => $templateFile->getClientOriginalName(),
                    ],
                    [
                        'name'     => 'branch',
                        'contents' => $data['branch']
                    ],
                ],
            ]);

            if ($response->getStatusCode() === 200) {
                $base64Template = base64_encode(file_get_contents($templateFile->getPathname()));
                $this->model->create([
                    'branch' => $branch->name,
                    'name' => $request->input('name'),
                    'count_photo' => 0,
                    'template' => $base64Template,
                ]);

                Log::info('Template data sent successfully.', ['response' => (string) $response->getBody()]);
                Alert::success('Created', 'Create ' . $this->title . ' Success');
                return redirect()->route('branchs.show' , $branch->id);
            }
        } catch (\Exception $e) {
            Log::error('Error sending template data: ' . $e->getMessage());
        }
    
        Alert::error('Created', 'Create ' . $this->title . ' Failed');
        return back();
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->model->where('id', $id)->first();
        return view($this->view . 'detail', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = $this->model->where('id', $id)->first();
        return view($this->view . 'edit', [
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'template' => 'required',
        ]);

        $input = $request->all();

        $result = $this->model->where('id', $id)->update([
            'name' => $input['name'],
            'template' => $input['template'],
        ]);

        if ($result) {
            Alert::success('Updated', 'Update ' . $this->title . ' Success');
            return redirect()->route($this->route . 'index');
        }
        Alert::error('Updated', 'Update ' . $this->title . ' Failed');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $branch_id, string $id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|exists:templates,id',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Invalid ID'], 400);
        }

        $data = $this->model->where('id', $id)->first();
        $templateName = $data->name;
        $branchName = $data->branch;

        $url = "http://82.29.160.126:5001/delete-template";
        
        try {
            $client = new Client();
            $client->delete($url, [
                'query' => [
                    'template_name' => $templateName,
                    'branch' => $branchName,
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('External API error: ' . $e->getMessage());
        }

        $result = $this->model->where('id', $id)->forceDelete();
        if ($result) {
            return response()->json(['success' => true, 'message' => 'Successfully deleted ' . $this->title], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to delete ' . $this->title], 500);
        }
    }


}
