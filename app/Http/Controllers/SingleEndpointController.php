<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Redirect;
use App\Http\Requests;

class SingleEndpointController extends Controller
{
    public function query(Request $request, $projectName, $endpointName)
    {
        // get endpoint from database
        $project = \App\Project::where('name', $projectName)->firstOrFail();
        $endpoint = $project->endpoints()
                ->where('name', $endpointName)
                ->firstOrFail();

        // get original url
        $url = $endpoint->originalUrl;

        // insert fixed params
        $paramList = $endpoint->parameters()->get();
        if (!is_null($paramList))
        {
            foreach ($paramList as $param)
            {
                $url = str_replace('{'.$param->name.'}', $param->fixedValue, $url);
            }
        }

        // pass rest of the params
        foreach ($request->input() as $name => $value)
        {
            $url = str_replace('{'.$name.'}', $value, $url);
        }

        // TODO: check if some parameters are not added!
        // TODO: optional params!

        // query original url
        $response = file_get_contents($url);

        // modify response
        $responseJson = json_decode($response, true);
        $modificationList = $endpoint->modifications()->get();
        foreach ($modificationList as $mod)
        {
            $parsedValue = json_decode($mod->value, true);
            array_set($responseJson, $mod->path, $parsedValue);
        }
        $modifiedResponse = json_encode($responseJson);

        // return modified response
        return (new Response($modifiedResponse, 200))
                ->header('Content-Type', 'application/json')
                ->header('Original-Url', $url);
    }


    public function showEditable(Request $request, $projectName, $endpointName)
    {
        $proj = \App\Project::where('name', '=', $projectName)->firstOrFail();
        $endpoint = $proj->endpoints()->where('name', '=', $endpointName)->firstOrFail();
        $modList = $proj->modifications;

        $endpointMods = $endpoint->modifications;
        $modSelectionList = [];
        foreach($endpointMods as $singleMod)
        {
            array_push($modSelectionList, $singleMod->id);
        }

        // show endpoints list
        return view('endpointEditableView', [
            'modList' => $modList,
            'modSelectionList' => $modSelectionList,
            'endpoint' => $endpoint,
            'projectName' => $projectName
        ]);
    }


    public function removeParameter(Request $request, $projectName, $endpointName, $parameterId)
    {
        // get parameter
        $parameter = \App\Parameter::where('id', '=', $parameterId)->firstOrFail();

        // remove parameter
        $parameter->delete();

        // back to previous page
        return redirect()->back();
    }


    public function editEndpoint(Request $request, $projectName, $endpointName)
    {
        // validate data
        $this->validate($request, [
            'originalUrl' => 'required|url',
            'params.*' => 'alpha_dash|required_with:fixedValues',
            'fixedValues.*' => 'alpha_dash|required_with:params',
            'modificationIds.*' => 'numeric'    // TODO: validate if modifications exists
        ]);

        // get endpoint object
        $proj = \App\Project::where('name', '=', $projectName)->firstOrFail();
        $endpoint = $proj->endpoints()->where('name', '=', $endpointName)->firstOrFail();

        // update url
        $endpoint->originalUrl = $request->input('originalUrl');

        // update parameters
        $endpoint->parameters()->delete();
        $newParams = $request->input('params');
        $newFixedValues = $request->input('fixedValues');
        for ($i = 0; $i < count($newParams); $i++)
        {
            $param = new \App\Parameter();
            $param->name = $newParams[$i];
            $param->fixedValue = $newFixedValues[$i];
            $param->endpointId = $endpoint->id;
            $param->save();
        }

        // update modifications
        $modificationIds = $request->input('modificationIds');
        if (is_null($modificationIds))
        {
            $modificationIds = [];
        }
        $endpoint->modifications()->sync($modificationIds);

        // show details of enpoint
        return redirect()->action('EndpointListController@showList', [
            'projName' => $projectName
        ]);
    }


    public function removeEndpoint(Request $request, $projName, $endpointName)
    {
        // get endpoint object
        $proj = \App\Project::where('name', '=', $projName)->firstOrFail();
        $endpoint = $proj->endpoints()->where('name', '=', $endpointName)->firstOrFail();

        // remove endpoint
        $endpoint->delete();

        // back to previous page
        return redirect()->back();
    }
}
