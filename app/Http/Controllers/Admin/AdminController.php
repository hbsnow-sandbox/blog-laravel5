<?php namespace App\Http\Controllers\Admin;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AdminController extends Controller
{

    /**
     * 管理者ページ表示
     *
     * @return Response
     */
    public function getIndex()
    {
        if (Auth::check()) {
            return view('admin.contents.home')->with('user', Auth::user());
        }

        return view('admin.contents.login');
    }

    /**
     * ログインPOST
     *
     * @return void
     */
    public function postIndex(Request $request)
    {
        $inputs = $request->only('email', 'password');

        if (Auth::attempt($inputs, true)) {
            return redirect()->back();
        }

        $message = 'ユーザ名もしくはパスワードが正しくありません。';
        return view('admin.contents.login')->with('error', $message);
    }

    /**
     * 管理者ページからログアウト
     *
     * @return Response
     */
    public function getLogout()
    {
        Auth::logout();

        return redirect()->route('admin.index');
    }

}
