<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(string $page, string $action = "index", string $id = "-")
    {

        if ($action == "index") {
            if (view()->exists("pages.{$page}")) {
                return view("pages.{$page}");
            } else if (view()->exists("master.{$page}.index")) {
                $data['id'] = $id;
                $vcontroller = "App\Http\Controllers\\" . ucfirst($page) . "Controller";
                // dd($page,$action,$vcontroller);
                return app($vcontroller)->$action($data);
            }
            return abort(404);
        } else {
            $data['id'] = $id;
            $vcontroller = "App\Http\Controllers\\" . ucfirst($page) . "Controller";
            // dd($page,$action,$vcontroller);
            return app($vcontroller)->$action($data);
        }
    }
}
