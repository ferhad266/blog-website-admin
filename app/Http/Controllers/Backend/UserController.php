<?php

namespace App\Http\Controllers\Backend;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['user'] = User::all()->sortBy('user_must');
        return view('backend.users.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6'
        ]);


        if ($request->hasFile('user_file')) {
            $request->validate([
                'user_file' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $fileName = uniqid() . '.' . $request->user_file->getClientOriginalExtension();
            $request->user_file->move(public_path('images/users'), $fileName);
        } else {
            $fileName = null;
        }


        $user = User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_file' => $fileName,
        ]);

        if ($user) {
            return redirect(route('user.index'))->with('success', 'Successfully added!');
        }

        return back()->with('error', 'Not successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::where('id', $id)->first();
        return view('backend.users.edit')->with('users', $users);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
//            'password' => 'required|min:6'
        ]);


        if ($request->hasFile('user_file')) {
            $request->validate([
                'user_file' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);
            $fileName = uniqid() . '.' . $request->user_file->getClientOriginalExtension();
            $request->user_file->move(public_path('images/users'), $fileName);

            if (strlen($request->password > 0)) {
                $request->validate([
                    'password' => 'required|min:6'
                ]);
                $user = User::where('id', $id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'user_file' => $fileName,
                    'password' => Hash::make($request->password),
                    'user_status' => $request->user_status
                ]);
            } else {
                $user = User::where('id', $id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'user_file' => $fileName,
                    'user_status' => $request->user_status
                ]);
            }

            $path = 'images/users/' . $request->oldFile;
            if (file_exists($path)) {
                @unlink(public_path($path));
            }

        } else {
            if (strlen($request->password > 0)) {
                $request->validate([
                    'password' => 'required|min:6'
                ]);
                $user = User::where('id', $id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'user_status' => $request->user_status
                ]);
            } else {
                $user = User::where('id', $id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'user_status' => $request->user_status
                ]);
            }


        }


        if ($user) {
            return back()->with('success', 'Successfully added!');
        }

        return back()->with('error', 'Not successfully added!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find(intval($id));
        if ($user->delete()) {
            echo 1;
        }
        echo 0;
    }

    public function sortable()
    {
//        print_r($_POST['item']);

        foreach ($_POST['item'] as $key => $value) {
            $users = User::find(intval($value));
            $users->user_must = intval($key);
            $users->save();
        }

        echo true;
    }
}
