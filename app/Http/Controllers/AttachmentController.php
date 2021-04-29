<?php

namespace App\Http\Controllers;

use Str;
use Illuminate\Http\Request;

class AttachmentController extends Controller
{
    public function get(Request $request, $entity, $id)
    {
        $model =  sprintf("\App\Models\%s", Str::singular(Str::studly($entity)));

        $data = (new $model)::find($id)->media()->get()
        ->map(function($m) {
            $m->full_url = $m->getFullUrl();
            $m->size_human_readable = $m->human_readable_size;
            return $m;
        })
        ->groupBy('collection_name')
        ->toArray();
    
        return $this->respond(compact('data'));
    }
    
    public function upload(Request $request, $entity, $id)
    {
        $attachment_group = Str::slug($request->get('attachment_group', 'default'));
        
        $model =  sprintf("\App\Models\%s", Str::singular(Str::studly($entity)));

        $result = (new $model)::find($id)->addMediaFromRequest('file')->toMediaCollection($attachment_group);
        return response()->json($result);
    }
}
