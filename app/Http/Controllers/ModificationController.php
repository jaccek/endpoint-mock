<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ModificationController extends Controller
{
    public function showList(Request $request)
    {
        $modificationList = \App\Modification::get();

        return view('modificationListView', [
            'modList' => $modificationList
        ]);
    }


    public function showEditable(Request $request, $modId)
    {
        // TODO: implement
    }


    public function editModification(Request $request, $modId)
    {
        // TODO: implement
    }
}
