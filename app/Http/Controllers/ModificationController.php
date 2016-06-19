<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ModificationController extends Controller
{
    public function showList(Request $request)
    {
        // get modifications list
        $modificationList = \App\Modification::get();

        // show view
        return view('modificationListView', [
            'modList' => $modificationList
        ]);
    }


    public function showEditable(Request $request, $modId)
    {
        // get modification
        $modification = \App\Modification::where('id', '=', $modId)->firstOrFail();

        // show view
        return view('modificationEditableView', [
            'modification' => $modification
        ]);
    }


    public function editModification(Request $request, $modId)
    {
        // validate data
        $this->validate($request, [
            'path' => 'required|regex:/^[a-zA-Z0-9\.-_]+$/',
            //'value' => 'alpha_dash|required_with:params',
        ]);

        // get modification
        $modification = \App\Modification::where('id', '=', $modId)->firstOrFail();

        // update values
        $modification->path = $request->input('path');
        $modification->value = $request->input('value');
        $modification->save();

        // show modifications list
        return redirect()->action('ModificationController@showList');
    }
}
