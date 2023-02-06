<?php

namespace App\LiveCMS\Controllers;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use PHPHtmlParser\Dom;
use PHPHtmlParser\Options;

class TextEditController extends Controller
{
    public function index(){
        return view('quick_cms.stat_text_iframe');
    }

    public function update(Request $request){
        $dom = new Dom;
        $dom->setOptions(
            (new Options())->setPreserveLineBreaks(true)->setRemoveScripts(false)->setRemoveStyles(false)
        );

        $inp = $request->all();
        
        if(array_key_exists('changes',$inp)){
            foreach($inp['changes'] as $key =>  $changes_arr){
                $section_id = $changes_arr['editable_id'];
                $edited_data = $changes_arr['edited_text'];
                if($changes_arr['component'] == ""){
                    $page_template = get_templates_path() . $changes_arr['route_name'];
                    $page_template_content = file_get_contents($page_template . '.blade.php');
        
                    $dom->loadStr($page_template_content);
                    
                    $section_id = $changes_arr['editable_id'];
                    $edited_data = $changes_arr['edited_text'];
        
                    $a = $dom->find('[data-editable-id]')[$changes_arr['position']];
                    if($a != null){                
                        $a->firstChild()->setText($edited_data);
                    }

                    file_put_contents($page_template . '.blade.php',$dom);
                    
                }else{
                    $related_template = get_component_templates_path() . $changes_arr['component'];
                    $related_template_content = file_get_contents($related_template . '.blade.php');
        
                    $dom->loadStr($related_template_content);
                    
                    $section_id = $changes_arr['editable_id'];
                    $edited_data = $changes_arr['edited_text'];
        
                    $a = $dom->find('[data-editable-id]')[$changes_arr['position_in_component']];
                    if($a != null){                
                        $a->firstChild()->setText($edited_data);
                    }

                    file_put_contents($related_template . '.blade.php',$dom);
                }
            }
        }else{
            if($inp['component'] == ""){
                $page_template = get_templates_path() . $inp['route_name'];
                $page_template_content = file_get_contents($page_template . '.blade.php');
    
                $dom->loadStr($page_template_content);
                
                $section_id = $inp['editable_id'];
                $edited_data = $inp['edited_text'];
    
                $a = $dom->find('[data-editable-id]')[$inp['position']];
                if($a != null){                
                    $a->firstChild()->setText($edited_data);
                }

                file_put_contents($page_template . '.blade.php',$dom);

            }else{

                $related_template = get_component_templates_path() . $inp['component'];
                $related_template_content = file_get_contents($related_template . '.blade.php');
    
                $dom->loadStr($related_template_content);
                
                $section_id = $inp['editable_id'];
                $edited_data = $inp['edited_text'];
    
                $a = $dom->find('[data-editable-id]')[$inp['position_in_component']];
                if($a != null){                
                    $a->firstChild()->setText($edited_data);
                }

                file_put_contents($related_template . '.blade.php',$dom);
            }
        }

        return back()->with('status', 'Text updated!');
    }
}
