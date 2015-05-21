<?php namespace App\Http\Controllers\Admin\Blog;

use App\Http\Requests;
use App\Http\Requests\Admin\DestroyRequest;
use App\Http\Requests\Admin\Blog\IconRequest;
use App\Http\Controllers\Controller;

use App\Eloquent\Blog\Icon;

class IconController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $icon = Icon::orderBy('id', 'asc')->get();

        return view('admin.contents.blog.icon.index')->with('icons', $icon);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(IconRequest $request)
    {
        $inputs = $request->only('name', 'url');

        Icon::create([
            'name' => array_get($inputs, 'name'),
            'url' => array_get($inputs, 'url'),
            'created_at' => new \DateTime,
            'updated_at' => new \DateTime,
        ]);

        return redirect()->route('admin.blog.icon.index')
                         ->with('success', '新規アイコンを保存しました。');
    }

    /**
     * 削除の確認画面
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $icon = Icon::find($id);

        return view('admin.contents.blog.icon.show')->with('icon', $icon);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $icons = Icon::all();
        $selected = Icon::find($id);

        return view('admin.contents.blog.icon.edit')->with('icons', $icons)
                                                    ->with('selected', $selected);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(IconRequest $request, $id)
    {
        $inputs = $request->only('name', 'url');

        $icon = Icon::find($id);

        $icon->name = array_get($inputs, 'name');
        $icon->url = array_get($inputs, 'url');
        $icon->save();

        return redirect()->route('admin.blog.icon.edit', $id)
                         ->with('selected', $icon)
                         ->with('success', 'アイコンを編集しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(DestroyRequest $request, $id)
    {
        Icon::destroy($id);

        return redirect()->route('admin.blog.icon.index')
                         ->with('success', 'アイコンを削除しました。');
    }

}
