<?php

namespace App\LiveCMS\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Image;

class ImagesController extends Controller
{
    public function index(){
        return view('livecms.editable-img-form-iframe');
    }

    public function post_upload(Request $request){
        $request->validate([
            'file' => 'required|mimes:jpg,png,svg|max:2048',
            'file_name' => 'required',
        ]);
        
        $uploaded_image = $request->file('file');
        
        //regular expression for findout display width constraint (i.e 480w, 120w, 240w etc) 
        // $reg_exp = "/[0-9]{2,4}w/i";

        if($request->input('file_name')){
            $img_src_name = $request->input('file_name');
            if(strpos($img_src_name, ',')){
                $images = explode(',',$img_src_name);
                foreach($images as $image){
                    $img = explode(' ',trim($image));

                    $img_path_arr = explode('/',$img[0]);
                    $arr_length = count($img_path_arr);
                    //old image info
                    $old_img =  Image::make(public_path($img[0]));
                    $old_img_name = $old_img->filename;
                    $old_img_ext = $old_img->extension;
                    $old_img_width = $old_img->width();
                    $old_img_height = $old_img->height();

                    $directory = public_path($img_path_arr[$arr_length-2]);
                    $filename = $old_img_name.'.'.$old_img_ext;
                    $upload_success = Image::make($uploaded_image)
                            ->resize($old_img_width,$old_img_height)
                            ->save($directory.'/'.$filename);

                }
            }else{
                $images = $img_src_name;
                $img_path_arr = explode('/',$images);
                $arr_length = count($img_path_arr);
                $old_img =  Image::make(public_path($images));
                $old_img_name = $old_img->filename;
                $old_img_ext = $old_img->extension;
                $old_img_width = $old_img->width();
                $old_img_height = $old_img->height();

                $directory = public_path($img_path_arr[$arr_length-2]);
                $filename = $old_img_name.'.'.$old_img_ext;
                $upload_success = Image::make($uploaded_image)
                            ->resize($old_img_width,$old_img_height)
                            ->save($directory.'/'.$filename);
            }
        }

        
        if( $upload_success ) {
        	return Response::json('success', 200);
        } else {
        	return Response::json('error', 400);
        }
    }
}
