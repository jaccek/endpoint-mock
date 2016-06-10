<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class EndpointListController extends Controller
{
    public function showList(Request $request, $projectName)
    {
        // get project and ids endpoints
        $proj = \App\Project::where('name', '=', $projectName)->firstOrFail();
        $endpointList = $proj->endpoints()->get();

        // show endpoints list
        return view('endpointListView', [
            'endpointList' => $endpointList,
            'projectName' => $projectName
        ]);
    }

    public function addEndpoint(Request $request, $projectName)
    {
        // validate data
        $this->validate($request, [
            'endpointName' => 'required|alpha_dash|unique:endpoints,name',
            'originalUrl' => 'required|url'
        ]);

        // get project
        $proj = \App\Project::where('name', '=', $projectName)->firstOrFail();

        // create new endpoint
        $newEndpoint = new \App\Endpoint();
        $newEndpoint->name = $request->input('endpointName');
        $newEndpoint->originalUrl = $request->input('originalUrl');
        $newEndpoint->httpMethod = "GET";
        $newEndpoint->delay = 0;
        $newEndpoint->projectId = $proj->id;
        $newEndpoint->save();

        return redirect()->back();
    }
}
