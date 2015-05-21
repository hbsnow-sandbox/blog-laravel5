<?php namespace App\Http\Controllers\Admin\Blog;

use App\Http\Requests;
use App\Http\Requests\Admin\DestroyRequest;
use App\Http\Requests\Admin\Blog\TagRequest;
use App\Http\Controllers\Controller;

use App\Eloquent\Blog\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $tags = Tag::orderBy('id', 'asc')->get();

        return view('admin.contents.blog.tag.index')->with('tags', $tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TagRequest $request
     * @return Response
     */
    public function store(TagRequest $request)
    {
        $inputs = $request->only('name', 'slug');

        Tag::create([
            'name' => array_get($inputs, 'name'),
            'slug' => array_get($inputs, 'slug'),
            'created_at' => new \DateTime,
            'updated_at' => new \DateTime,
        ]);

        return redirect()->route('admin.blog.tag.index')
                         ->with('success', '新規タグを保存しました。');
    }

    /**
     * 削除の確認画面
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $tag = Tag::find($id);

        return view('admin.contents.blog.tag.show')->with('tag', $tag);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $tags = Tag::all();
        $selected = Tag::find($id);

        return view('admin.contents.blog.tag.edit')
            ->with('tags', $tags)
            ->with('selected', $selected);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(TagRequest $request, $id)
    {
        $inputs = $request->only('name', 'slug');

        $tag = Tag::find($id);

        $tag->name = array_get($inputs, 'name');
        $tag->slug = array_get($inputs, 'slug');
        $tag->save();

        return redirect()->route('admin.blog.tag.edit', $id)
                         ->with('selected', $tag)
                         ->with('success', 'タグを編集しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(DestroyRequest $request, $id)
    {
        Tag::destroy($id);

        return redirect()->route('admin.blog.tag.index')
                         ->with('success', 'タグを削除しました。');
    }

}
