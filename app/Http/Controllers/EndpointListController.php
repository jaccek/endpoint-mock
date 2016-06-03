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
        // check if we have endpoint with given name
        $proj = \App\Project::where('name', '=', $projectName)->firstOrFail();
        $count = $proj->endpoints()->where('name', '=', $request->input('endpointName'))->count();
        if ($count != 0)
        {
            // TODO: temporary
            return abort(500, "Endpoint with that name already added to this project");
        }

        $newEndpoint = new \App\Endpoint();
        $newEndpoint->name = $request->input('endpointName');
        $newEndpoint->originalUrl = $request->input('originalUrl');
        $newEndpoint->httpMethod = "GET";
        $newEndpoint->delay = 0;
        $newEndpoint->projectId = $proj->id;
        $newEndpoint->save();

        return redirect()->back();
    }

    public function showDetails(Request $request, $projectName, $endpointName)
    {
        $proj = \App\Project::where('name', '=', $projectName)->firstOrFail();
        $endpoint = $proj->endpoints()->where('name', '=', $endpointName)->firstOrFail();

        // show endpoints list
        return view('endpointDetailsView', [
            'endpoint' => $endpoint,
        ]);
    }
}
