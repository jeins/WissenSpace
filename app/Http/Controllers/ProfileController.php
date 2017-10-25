<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    const PROFILE_PHOTO_PATH = 'profile';
    const PROFILE_SOCIAL_MEDIA = ['linkedin', 'twitter', 'github', 'website'];

    public function show($name)
    {
        $user = User::with('products.comments')->where('name', $name)->first();

        $isAllowEdit = $this->isAllowToEdit($user->id);
        $socialMedia = json_decode($user->social_media);

        return view('user.profile', compact('user', 'isAllowEdit', 'socialMedia'));
    }


    public function update(Request $request, $userId)
    {
        $user = User::find($userId);
        $socialMediaData = [];

        foreach (self::PROFILE_SOCIAL_MEDIA as $socialMedia) {
            if ($request[$socialMedia]) {
                $socialMediaData[$socialMedia] = $request[$socialMedia];
            }
        };

        $user->update([
            'full_name' => $request->full_name,
            'status' => $request->status,
            'social_media' => json_encode($socialMediaData),
            'photo' => $request->photo
        ]);

        return redirect(route('profile.show', $user->name))->with('success', 'berhasil update...');
    }
}
