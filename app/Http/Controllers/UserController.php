<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('agent.index');
    }

    public function show($id)
    {
        $agent = User::find($id);
        if ($agent) {
        // Return success response if data is updated successfully
        return response()->json(['code' => 200 , 'agent' => $agent], 200);
        } 
        // If agent Doesn't Exists
        return response()->json(['code' => 422, 'msg' => "Ce agent n'existe pas"], 404);
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
        $agents = User::latest()->paginate(10);
        return response()->json(['code' => 200, 'agents' => $agents], 200);
    }

    public function delete($id)
    {
        $agent = User::find($id);
        if ($agent) {
            return response()->json(['status' => 200, 'agent' => $agent], 200); 
        }
        return response()->json(['status' => 404, 'msg' => "Cette information n'existe pas"], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $agent = User::find($id);
        if ($agent) {
            $agent->delete();
            return response()->json(['status' => 200, 'success' => 'Opération effectuée avec succès.'], 200);
        }
        return response()->json(['status' => 404,'msg' => "Cette information n'existe pas"], 404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $agent = User::find($id);
        // dd($agent);
        if ($agent) {
            return response()->json(['status' => 200, 'agent' => $agent], 200); 
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
        if ($request->password) {
            $formData['password'] = Hash::make($request->password);
        }
        $agent = User::find($id);
        if ($agent) {
            $agent->update($formData);
            // Return success response if data is updated successfully
            return response()->json(['status' => 200, 'msg' => 'Opération effectuée avec succès.'], 200); 
        } 
        return response()->json(['status' => 404,'msg' => "Cette information n'existe pas"], 404);
    }

    public function search(Request $request)
    {

        $value = $request->search;
        $result = User::where('nom', 'like', "%$value%")
        ->orWhere('prenom', 'like', "%$value%")
        ->orWhere('cin', 'like', "%$value%")
        ->orWhere('email', 'like', "%$value%")
        ->orWhere('telephone', 'like', "%$value%")
        ->latest()
        ->paginate(10);
        $result->appends($request->all());
        return response()->json(['agents' => $result]);
    }
}
