<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;

class CloundImageController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function handle()
    {
        $ext = pathinfo(request()->url)['extension'];
    	$img = Image::cache(function($image) {
	    	$url = request()->url;
            $url = parse_url($url)['path'];
	    	$width = request()->width; 
	    	$img = $image->make(bc_image_generate_thumb($url,$width,$width));
		});
    	return Image::make($img,200)->response($ext);
    }
}
