<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Question;
use App\Models\Result;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\View;
use App\TheoryMarker\QuestionService;
use Illuminate\Support\Facades\Hash;
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
        $questions = Question::all();
        return view('admin/home')
            ->with('questions', $questions);
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $formData = $request->all();
        try {
            (new QuestionService())->addQuestion($formData);
            Session::flash('status', 'Successfully added Question!');
        } catch (Exception $e) {
            $errors = new MessageBag(['error' => $e->getMessage()]);
            return Redirect::back()->withErrors($errors);
        }
        return Redirect::action([HomeController::class, 'index']);
    }

    public function edit(int $question)
    {
        $currentQuestion = Question::find($question);

        return view('admin.edit-question')
            ->with('currentQuestion', $currentQuestion);
    }

    public function update(Request $request, $id)
    {
        $formData = $request->all();
        $questionId = $id;
        try {
            (new QuestionService())->updateQuestion($formData, $questionId);
            Session::flash('status', 'Successfully updated Question!');
        } catch (Exception $e) {
            $errors = new MessageBag(['error' => $e->getMessage()]);
            return Redirect::back()->withErrors($errors);
        }
        return redirect('/home');
    }

    public function delete($id)
    {
        $question = Question::find($id);
        $question->delete();
        Session::flash('status', 'Successfully deleted Question!');
        return redirect('/home');
    }

    public function createLecturerForm()
    {
        return view('admin.add-lecturer');
    }

    public function createLecturer(Request $request)
    {
        $name = $request['name'];
        $email =  $request['email'];
        $password = $request['password'];
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => '1'
        ]);

        $request->session()->flash('lecturer', 'Lecturer Created Succesfully');
        return view('admin.add-lecturer')
            ->with('name', $name)
            ->with('email', $email)
            ->with('password', $password);
    }


    public function createStudentForm()
    {
        return view('lecturer.add-student');
    }


    public function createStudent(Request $request)
    {
        $name = $request['name'];
        $email =  $request['email'];
        $regNo =  $request['regNo'];
        $password = $request['password'];

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'regNo' => $regNo,
            'password' => Hash::make($password),
            'reg_no' => $regNo,
            'role' => '0'

        ]);
  
        $request->session()->flash('student', 'Student Created Succesfully');
        return view('/lecturer.add-student')
            ->with('name', $name)
            ->with('email', $email)
            ->with('regNo', $regNo)
            ->with('password', $password);
    }
}
