<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class RootFrontController extends Controller
{
    public $templatePath;
    public $templateFile;
    public function __construct()
    {
        $this->templatePath = 'templates.' . bc_store('template');
        $this->templateFile = 'templates/' . bc_store('template');
    }


    /**
     * Default page not found
     *
     * @return  [type]  [return description]
     */
    public function pageNotFound()
    {
        bc_check_view( $this->templatePath . '.Error.404');
        return view(
             $this->templatePath . '.Error.404',
            [
            'title' => trans('front.page_not_found_title'),
            'msg' => trans('front.page_not_found'),
            'description' => '',
            'keyword' => ''
            ]
        );
    }

    /**
     * Default item not found
     *
     * @return  [view]
     */
    public function itemNotFound()
    {
        bc_check_view( $this->templatePath . '.Error.404');
        return view(
             $this->templatePath . '.Error.404',
            [
                'title' => trans('front.item_not_found_title'),
                'msg' => trans('front.item_not_found'),
                'description' => '',
                'keyword' => '',
            ]
        );
    }
}
