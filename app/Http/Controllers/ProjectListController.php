<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;

class ProjectListController extends Controller
{
    public function showList()
    {
        // get all projects
        $projectList = \App\Project::get();

        // show project list
        return view('projectListView', [
            'projectList' => $projectList
        ]);
    }


    public function addProject(Request $request)
    {
        // validate data
        $this->validate($request, [
            'projectName' => 'required|alpha_dash|unique:projects,name'
        ]);

        $project = new \App\Project();
        $project->name = $request->input('projectName');
        $project->save();

        return redirect()->back();
    }


    public function removeProject(Request $request, $projName)
    {
        // get project object
        $project = \App\Project::where('name', '=', $projName)->firstOrFail();

        // remove project
        $project->delete();

        // back to previous view
        return redirect()->back();
    }
}
