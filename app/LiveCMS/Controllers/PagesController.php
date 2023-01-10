<?php

namespace App\LiveCMS\Controllers;

use App\Http\Controllers\Controller;
use App\LiveCMS\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Template::all();
        return view('livecms.admin.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('livecms.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'page_name' => 'required',
            'route' => 'required',
        ]);


        if ($validator->fails()) {
            return redirect('cms/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        //check if route name already exists
        $route_name = Str::slug($request['route']);
        $route_exists_check = Template::where('route',$route_name)->exists();
        if($route_exists_check){
            return redirect('cms/create')->with('error','Route already exists !');
        }
        
        //check if blade file already exists
        if (View::exists($route_name)) 
        {
            return redirect('cms/create')->with('error','Blade File already exists !');
        }
        else
        {
            $template_file = fopen(get_templates_path().$route_name.'.blade.php','w');
            fwrite($template_file,'<x-layout> </x-layout>');
            fclose($template_file);
        }

        Template::create([
            'route' => $route_name,
            'template' => '<x-layout> </x-layout>',
            'path' => $route_name,
        ]);

        return redirect('cms')->with('success', 'Template saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function show(Template $template)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function edit(Template $cm)
    {
        
        $page_template = get_templates_path() . $cm->path;
        $page_template_content = file_get_contents($page_template . '.blade.php');

        $components = get_component_tags($page_template_content);
        $components = array_filter($components, function($v) {
            return $v !== 'layout'; 
        });

        if (! request()->has('template')) {
            if (crc32($page_template_content) !== $cm->template_checksum) {
                $cm->template = $page_template_content;
                $cm->save();
            }
        }

        if ($tpl = request()->get('template')) {
            $related_template = get_component_templates_path() . $tpl;
            $related_template_content = file_get_contents($related_template . '.blade.php');
            $page_template_content = $related_template_content;
        }
        
        return view('livecms.admin.edit', [
            'data' => $cm,
            'page_template_content' => $page_template_content,
            'components' => $components
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Template $cm)
    {
        if ($tpl = $request->get('related_template')) {
            $result = file_put_contents(get_component_templates_path() . $tpl . '.blade.php',  $request->template);
        } else {
            $result = $cm->update($request->all());
            if ($result) {
                file_put_contents(get_templates_path() . $cm->path . '.blade.php',  $request->template);
            }
        }

        if ($result) {
            return back()->withInput()->with('status', 'Saved the changes!');
        } 
        
        return back()->withInput()->with('status', 'Not saved due to backend error!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function destroy(Template $template)
    {
        //
    }
}
