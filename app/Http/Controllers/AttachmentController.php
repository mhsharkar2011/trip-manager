<?php

namespace App\Http\Controllers;

use Str;
use Illuminate\Http\Request;

class AttachmentController extends Controller
{
    public function get(Request $request, $entity, $id)
    {
        $model =  sprintf("\App\Models\%s", Str::singular(Str::studly($entity)));
        return response()->json((new $model)::find($id)->getMedia());
    }
    
    public function upload(Request $request, $entity, $id)
    {
        $attachment_group = $request->get(Str::slug('attachment_group'), 'default');
        
        $model =  sprintf("\App\Models\%s", Str::singular(Str::studly($entity)));

        $result = (new $model)::find($id)->addMediaFromRequest('file')->toMediaCollection($attachment_group);
        return response()->json($result);
    }
}
