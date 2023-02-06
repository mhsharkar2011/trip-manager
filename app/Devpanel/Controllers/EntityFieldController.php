<?php

namespace App\Devpanel\Controllers;

use Illuminate\Http\Request;
use App\Devpanel\Models\Field;
use App\Devpanel\Models\Entity;
use App\Http\Controllers\Controller;

class EntityFieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Entity  $entity
     * @return \Illuminate\Http\Response
     */
    public function index(Entity $entity)
    {
        return $this->respond($entity->fields()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Entity  $entity
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Entity $entity)
    {
        // dd($request->route('entity'));
        // dd($request->all());

        $validated = $request->validate(
            Field::validation_rules(),
            Field::validation_messages(),
        );

        return $this->respondCreated(Field::create($request->merge([
            'entity_id' => $entity->id
        ])->all()));
        //return $this->respondCreated($field::create($validated));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Entity  $entity
     * @param  \App\Models\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function show(Entity $entity, Field $field)
    {
        return $this->respond($field);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Entity  $entity
     * @param  \App\Models\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entity $entity, Field $field)
    {
        $validated = $request->validate(
            Field::validation_rules(),
            Field::validation_messages(),
        );

        $field->update($request->all());
        // $field->update($validated);

        return $this->respond($field);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Entity  $entity
     * @param  \App\Models\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entity $entity, Field $field)
    {
        $field->delete();

        return $this->respondDeleted();
    }
}
