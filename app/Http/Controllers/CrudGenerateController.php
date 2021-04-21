<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use App\Models\Entity;
use Illuminate\Http\Request;

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

        if ($request->has('route')) {
            $commandArg['--route'] = $request->route;
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
            Artisan::call('migrate');
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
