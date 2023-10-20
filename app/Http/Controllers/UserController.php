<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $Users = User::all();
        return view('user.index', compact('Users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //menampilkan layouting html pada folder resource-views
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required',
            'role' => 'required',
        ]);

        $pass = substr($request->name, 0, 3) . substr($request->email, 0, 3);
        
        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($pass),
            // 'password' => $request->password,
            'role' => $request->role,
        ]);
        //atau jika seluruh data input akan dimasukkan langsung ke db bisa dengan perintah Medicine::create($request->all());

        return redirect()->back()->with('success', 'Berhasil menambahkan data User!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $Users)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $Users, $id)
    {
        $Users = User::find($id);
        //atau $medicine = Medicine::wehre('id', $id)->first();
    
        return view('user.edit', compact('Users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $Users, $id)
    {
        //
        
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required',
            'role' => 'required'
        ]);

        // $pass = substr($request->email, 0, 3). substr($request->name, 0, 3);
        $pas = User::find($id);
        // DD($pas->password);

        if ($request->has('password')) {
            $password = $pas->password;
        } else {
            $password = Hash::make($request->password);
        }
        
        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
            'role' => $request->role,

        ]);

        return redirect()->route('user.home')->with('success', 'Berhasil mengubah data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $Users, $id)
    {
        //
        User::where('id', $id)->delete();

        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }

}
