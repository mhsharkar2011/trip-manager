<?php

namespace App\Http\Controllers;

use Str;
use Illuminate\Support\Facades\Artisan;
use App\Models\Entity;
use App\Models\Field;
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
            foreach ($entity->fields as $field) {
                // if ($request->fields_required[$x] == 1) {
                //     $validationsArray[] = $field;
                // }
                $fieldsArray[] = Str::slug($field->name, "_") . '#' . Field::getColumnTypeMapping($field->type);
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

        $commandArg['--controller-namespace'] = 'App\Http\Controllers';
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
            if ($entity->is_generated) {
                $name = Str::plural(Str::snake($entity->name));
                $files = glob(database_path() . '/migrations/*_create_'.$name.'_table.php');

                if (count($files) > 0 && File::exists($files[0])) {
                    File::delete($files[0]);
                }

                \Schema::dropIfExists($name);
            }

            Artisan::call('crud:api', $commandArg);

            Artisan::call('migrate');
            
            $entity->update([
                'is_generated' => true
            ]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
