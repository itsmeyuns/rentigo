<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('profile.index');
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), 
            [
            'new_password' => 'required|min:8|confirmed',
            'new_password_confirmation' => 'required',
            ],
            [
                'new_password.required' => 'Le champ nouveau mot de passe est obligatoire.',
                'new_password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
                'new_password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
                'new_password_confirmation.required' => 'Veuillez confirmer votre mot de passe.',
            ]
        );
    
        if ($validator->fails()) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'validation error',
                'errors' => $validator->errors()
            ], 422));
        } else {
            if (Hash::check($request->password, auth()->user()->password)) {
                User::findOrFail(auth()->user()->id)->update([
                    'password' => Hash::make($request->new_password)
                ]);
                return response()->json(['msg' => 'Le mot de passe a été mis à jour avec succès'], 200);
            } else {
                throw new HttpResponseException(response()->json([
                    'success' => false,
                    'message' => 'old password incorrect',
                    'errors' => ['password' => ["L'ancien mot de passe incorrect."]]
                ], 422));
            }
        }

    }

    public function updateInfos(ProfileRequest $request)
    {
        $formData = $request->validated();
        User::findOrFail(auth()->user()->id)->update($formData);
        return response()->json(['msg' => 'Les informations ont été mises à jour avec succès'], 200);
    }
}
