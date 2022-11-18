<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UploadService
{
    public function store($request)
    {
        if ($request->hasFile('file')) {
            try {
                $request->validate([
                    'file' => 'required|image|mimes:png,jpg,jpeg|max:2048'
                ]);

                $user_id = Auth::user()->id;

                $imageName = time() . '-' . $user_id . '.' . $request->file->extension();

                $request->file->move(public_path('images'), $imageName);

                DB::table('users')
                    ->where('id', $user_id)
                    ->update(['image' => '/images/' . $imageName]);

                return '/images/' . $imageName;
            } catch (\Exception $error) {
                return false;
            }
        }
    }
}
