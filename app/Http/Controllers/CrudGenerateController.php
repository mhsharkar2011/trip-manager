<?php

namespace App\Http\Controllers;

use Str;
use Illuminate\Support\Facades\Artisan;
use App\Models\Entity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CrudGenerateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Entity $entity)
    {
        // return $this->respond([], 'todo');

        $commandArg = [];
        $commandArg['name'] = \Str::remove(' ', $entity->name);

        if ($entity->has('fields')) {
            $fieldsArray = [];
            $validationsArray = [];
            $x = 0;
            foreach ($entity->fields as $field) {
                // if ($request->fields_required[$x] == 1) {
                //     $validationsArray[] = $field;
                // }

                $fieldsArray[] = $field->name . '#' . $field->type[$x];

                $x++;
            }

            $commandArg['--fields'] = implode(";", $fieldsArray);
        }

        if (!empty($validationsArray)) {
            $commandArg['--validations'] = implode("#required;", $validationsArray) . "#required";
        }

        if ($entity->is_generated) {
            $commandArg['--route'] = 'no';
        }

        if ($request->has('view_path')) {
            $commandArg['--view-path'] = $request->view_path;
        }

        if ($request->has('controller_namespace')) {
            $commandArg['--controller-namespace'] = $request->controller_namespace;
        }

        if ($request->has('model_namespace')) {
            $commandArg['--model-namespace'] = $request->model_namespace;
        }

        if ($request->has('route_group')) {
            $commandArg['--route-group'] = $request->route_group;
        }

        if ($request->has('relationships')) {
            $commandArg['--relationships'] = $request->relationships;
        }

        if ($request->has('form_helper')) {
            $commandArg['--form-helper'] = $request->form_helper;
        }

        if ($request->has('soft_deletes')) {
            $commandArg['--soft-deletes'] = $request->soft_deletes;
        }

        try {
            Artisan::call('crud:api', $commandArg);

            if ($entity->is_generated) {
                $files = glob(database_path() . '/migrations/*_create_'.Str::plural(Str::snake($entity->name)).'_table.php');

                if (count($files) > 0 && File::exists($files[0])) {
                    File::delete($files[0]);
                }
            }

            Artisan::call('migrate:fresh');
            
            $entity->update([
                'is_generated' => true
            ]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
