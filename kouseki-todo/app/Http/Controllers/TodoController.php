<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     //view
    public function index()
    {
        return view('login', [
            'title' => 'Login',
        ]);
    }

    public function create()
    {
        return view('dashboard.create',[
            'title' => 'Create',
        ]);
    }


    public function home()
    {
        return view('home',[
            'title' => 'Home',
        ]);
    }


    //register
    public function register()
    {
        return view('register',[
            'title' => 'Register',
        ]);
    }


    public function registerAccount(Request $request)
    {
        //Validasi data
        $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|min:3|max:255|unique:users',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255'
        ]);

        $request['password'] = bcrypt($request['password']);

       User::create($request->all());

       return redirect('/')->with('success', 'Registration successfull! Please login');

    }


    //Login
    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required',
        ],[
            'email.exists' => 'Email ini belum tersedia',
            'email.required' => 'Email tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
        ]);
        
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/dashboard')->with('success', 'Login Success!');
        }
        
        return back()->with('LoginError', 'Login failed!');
    }
    
    //logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken(); 

        return redirect('/');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3',
            'date' => 'required',
            'description' => 'required|min:5'
        ]);

        Todo::create([
            'title' => $request->title,
            'date' => $request->date,
            'description' => $request->description,
            'status' => 0,
            'user_id' => Auth::user()->id,
        ]);

        return redirect('/dashboard')->with('successAdd','Berhasil menambahkan Todo!');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTodoRequest  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(request $request, $id)
    {
        $todo = Todo::find($id);
        return view('dashboard.edit', compact('todo'),[
            'title' => 'Edit',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTodoRequest  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $request->validate([
            'title' => 'required|min:3',
            'date' => 'required',
            'description' => 'required|min:5'
        ]);

        Todo::where('id', $id)->update([
            'title' => $request->title,
            'date' => $request->date,
            'description' => $request->description,
            'status' => 0,
            'user_id' => Auth::user()->id,
        ]);

        return redirect('/dashboard')->with('successUpdate', 'Berhasil Mengedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Todo::find($id)->delete();
        return redirect('/dashboard')->with('successDel', 'Berhasil Menghapus');
    }


    public function done()
    {
        $todos = Todo::where('status',1)->get();
        return view('dashboard.completed',compact('todos'),[
            'title' => 'Completed',
        ]);
    }

    public function updateDone($id)
    {
        $todo = Todo::where('id', $id)->update(
            [
                'status' => 1,
                'done_time' => now()
            ]
        );
        if($todo) {
            return redirect()->route('dashboard')->with('updated',"negro");
        }else{
            return redirect()->route('dashboard')->with('error',"negro");
        }
    }

    public function undo($id)
    {
        $todo = Todo::where('id', $id)->update(
            [
                'status' => 0,
                'done_time' => null
            ]
        );
        if($todo) {
            return redirect()->route('completed')->with('updated',"negro");
        }else{
            return redirect()->route('completed')->with('error',"negro");
        }
    }
}
