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
        //$params = \App\Parameter::where('endpointId', $endpoint->id)->get();
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
}
