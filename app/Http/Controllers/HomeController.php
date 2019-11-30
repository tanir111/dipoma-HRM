<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Post;
use Session;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('replies')->where('user_id', \Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('home', compact('posts'));
    }

    public function setLangEng()
    {
        Session::put('language', 'en');
        return redirect()->back();
    }

    public function setLangRus()
    {
        Session::put('language', 'ru');
        return redirect()->back();
    }



    public function setCurrencyKZT()
    {
        Session::put('currency', 'kzt');
        return redirect()->back();
    }

    public function setCurrencyRUB()
    {
        Session::put('currency', 'rub');
        return redirect()->back();
    }

    public function setCurrencyUSD()
    {
        Session::put('currency', 'usd');
        return redirect()->back();
    }
}
