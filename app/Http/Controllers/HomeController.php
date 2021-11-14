<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\View;
use App\TheoryMarker\QuestionService;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Console\Helper\QuestionHelper;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin/home');
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $formData = $request->all();
        try{
            (new QuestionService())->addQuestion($formData);
            Session::flash('status', 'Successfully added Question!');
        }
        catch(Exception $e){
            $errors = new MessageBag(['error'=>$e->getMessage()]);
            return Redirect::back()->withErrors($errors);
        }
        return view('admin/home');
    }
}
