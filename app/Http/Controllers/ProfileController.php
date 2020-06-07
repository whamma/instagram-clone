<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        return view('profiles.index', [
            'user' => $user,
        ]);
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);

        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {
        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => ''
        ]);
        
        if (request('image')) {
            $imagePath = request('image')->store('uploads', 'public');
            
            $image = Image::make(public_path("storage/{$imagePath}"))
            ->fit(1000, 1000);
            $image->save();
            
            $data['image'] = $imagePath;
        }
        
        auth()->user()->profile->update($data);
        
        return redirect("/profile/{$user->id}");
    }
}
