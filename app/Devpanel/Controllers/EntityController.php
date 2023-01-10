<?php

namespace App\Devpanel\Controllers;

use Illuminate\Http\Request;
use App\Devpanel\Models\Entity;
use App\Http\Controllers\Controller;

class EntityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Entity $entity)
    {
        return response()->json($entity::latest()->simplePaginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Entity $entity)
    {
        $validated = $request->validate(
            $entity::validation_rules(),
            $entity::validation_messages(),
        );

        return $this->respondCreated($entity::create($request->all()));
        //return $this->respondCreated($entity::create($validated));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Entity  $entity
     * @return \Illuminate\Http\Response
     */
    public function show(Entity $entity)
    {
        return $this->respond($entity);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Entity  $entity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entity $entity)
    {
        $validated = $request->validate(
            $entity::validation_rules(),
            $entity::validation_messages(),
        );

        $entity->update($validated);

        return $this->respond($entity);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Entity  $entity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entity $entity)
    {
        Entity::deleteMigrationAndDBTable($entity->name);
        
        $entity->delete();

        return $this->respondDeleted();
    }
}
