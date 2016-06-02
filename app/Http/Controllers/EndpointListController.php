<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class EndpointListController extends Controller
{
    public function showList(Request $request, $projectName)
    {
        //dd($request->input('hello', 'dupa'));

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
        return redirect()->back();
    }
}
