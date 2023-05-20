<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
    }

    public function index()
    {
        return view('user.index');
    }

    public function show($id)
    {
        $user = User::find($id);
        if ($user) {
        // Return success response if data is updated successfully
        return response()->json(['code' => 200 , 'user' => $user], 200);
        } 
        // If user Doesn't Exists
        return response()->json(['code' => 422, 'msg' => "Ce user n'existe pas"], 404);
    }

    public function store(UserRequest $request)
    {
        $formData = $request->validated();
        $formData['password'] = Hash::make($request->password);
        User::create($formData);
        // Return success response if data is inserted successfully
        return response()->json(['code' => 200, 'msg' => 'Opération effectuée avec succès.'], 200); 
    }

    public function fetch()
    {
        $users = User::where('id' , '!=', auth()->user()->id)->where('role' , '!=', 'admin')->latest()->paginate(10);
        return response()->json(['code' => 200, 'users' => $users], 200);
    }

    public function delete($id)
    {
        $user = User::find($id);
        if ($user) {
            return response()->json(['status' => 200, 'user' => $user], 200); 
        }
        return response()->json(['status' => 404, 'msg' => "Cette information n'existe pas"], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json(['status' => 200, 'success' => 'Opération effectuée avec succès.'], 200);
        }
        return response()->json(['status' => 404,'msg' => "Cette information n'existe pas"], 404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::find($id);
        if ($user) {
            return response()->json(['status' => 200, 'user' => $user], 200); 
        }
        return response()->json(['status' => 404, 'msg' => "Cette information n'existe pas"], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, $id)
    {
        // Validation
        $formData = $request->validated();

        if ($request->filled('password')) {
            $formData['password'] = Hash::make($request->password);
        } else {
            unset($formData['password']); // Remove the password field from the update data
        }
        $user = User::find($id);
        if ($user) {
            $user->update($formData);
            // Return success response if data is updated successfully
            return response()->json(['status' => 200, 'msg' => 'Opération effectuée avec succès.'], 200); 
        } 
        return response()->json(['status' => 404,'msg' => "Cette information n'existe pas"], 404);
    }

    public function search(Request $request)
    {

        $value = $request->search;
        $result = User::where(function ($query) use ($value) {
            $query->where('nom', 'like', "%$value%")
                ->orWhere('prenom', 'like', "%$value%")
                ->orWhere('cin', 'like', "%$value%")
                ->orWhere('email', 'like', "%$value%")
                ->orWhere('telephone', 'like', "%$value%");
        })
        ->where('id', '!=', auth()->user()->id)
        ->where('role' , '!=', 'admin')
        ->latest()
        ->paginate(10);
        $result->appends($request->all());
        return response()->json(['users' => $result]);
    }
}
