<?php namespace App\Http\Controllers;

class ErrorsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('pjax', ['only' => ['get404', 'get500', 'get503']]);
    }



    /**
     * 404
     *
     * @return Response
     */
    public function get404()
    {
        return view('errors.404')->with('title', '404 Not Found');
    }



    /**
     * 500
     *
     * @return Response
     */
    public function get500()
    {
        return view('errors.500')->with('title', '500 Internal Server Error');
    }



    /**
     * 503
     *
     * @return Response
     */
    public function get503()
    {
        return view('errors.503')->with('title', '503 Service Temporarily Unavailable');
    }
}
