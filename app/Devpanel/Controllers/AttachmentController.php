<?php

namespace App\Devpanel\Controllers;

use Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AttachmentController extends Controller
{
    public function get(Request $request, $entity, $id)
    {
        $model =  sprintf("\App\Models\%s", Str::singular(Str::studly($entity)));

        $data = (new $model)::find($id);

        $data = request()->has('attachment_group') ? $data->getMedia(request('attachment_group')) : $data->media()->get();
        
        $data = $data
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

    public function attach($entity,$id,$attachment_id)
    {
        $model =  sprintf("\App\Models\%s", Str::singular(Str::studly($entity)));
        $attachment_group = Str::slug(request('attachment_group', 'default'), '_');
        $disk = request('disk') ? request('disk') : 'public';

        $attachment_model = Media::find($attachment_id);

        $anotherModel = (new $model)::findOrFail($id);

        $entity_info = $attachment_model->copy($anotherModel, $attachment_group,$disk);
        if ($entity_info->id) {
            $entity_info->full_url = $entity_info->getFullUrl();
            $entity_info->size_human_readable = $entity_info->human_readable_size;
        }
        return $this->respondCreated($entity_info);
    }
}
