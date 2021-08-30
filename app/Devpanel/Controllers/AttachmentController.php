<?php

namespace App\Devpanel\Controllers;

use Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttachmentController extends Controller
{
    public function get(Request $request, $entity, $id)
    {
        $model =  sprintf("\App\Models\%s", Str::singular(Str::studly($entity)));

        $data = (new $model)::find($id)->media()->get()
        ->groupBy('collection_name')
        ->toArray();
    
        return $this->respond(compact('data'));
    }
    
    public function upload(Request $request, $entity, $id)
    {
        $attachment_group = Str::slug($request->get('attachment_group', 'default'), '_');
        
        $model =  sprintf("\App\Models\%s", Str::singular(Str::studly($entity)));

        $attachment = (new $model)::find($id)->addMediaFromRequest('file')->toMediaCollection($attachment_group);
        return response()->json($attachment);
    }

    public function delete(Request $request, $entity, $id, $attachment_id)
    {
        $model =  sprintf("\App\Models\%s", Str::singular(Str::studly($entity)));

        $attachment = (new $model)::find($id)->media()->find($attachment_id);

        if (is_null($attachment)) {
            return $this->respondNotFound();
        }

        try {
            $attachment->delete();
            return $this->respondDeleted();
        } catch (\Exception $e) {
            $this->respondError($e->getMessage());
        }
    }
}
