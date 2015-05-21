<?php namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;

class BaseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('pjax', ['only' => ['getIndex', 'getAbout', 'getWork', 'getContact']]);
    }



    /**
     * ホームの表示
     *
     * @return Response
     */
    public function getIndex()
    {
        $description = 'プログラムやウェブサイト制作についての学習記録、また制作した作品を公開するページです。';

        return view('contents.index')->with('description', $description);
    }



    /**
     * Aboutの表示
     *
     * @return Response
     */
    public function getAbout()
    {
        return view('contents.about.index')->with('title', 'About');
    }



    /**
     * Workの表示
     *
     * @return Response
     */
    public function getWork()
    {
        return view('contents.work.index')->with('title', 'Work');
    }

}
