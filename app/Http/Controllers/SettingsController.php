<?php

namespace Banijya\Http\Controllers;

use Banijya\Aavatar;
use Banijya\Http\Controllers\Controller;
use Banijya\Http\Requests;
use Banijya\Http\Requests\AavatarRequest;
use Banijya\Http\Requests\PasswordRequest;
use Banijya\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class SettingsController extends Controller
{
    protected $tabs = ['profile', 'password', 'aavatar'];

    /**
     * Settings Tab
     * @param   $request
     * @return  View ;
     */
    public function index(Request $request)
    {
        $tab = $request->get('tab', 'profile');
        if( ! in_array($tab, $this->tabs) ) return redirect('home');

        $user = auth()->user();

        return view("settings.{$tab}", compact('user'));
    }

    /**
     * Update your profile
     * @param  ProfileRequest $request [description]
     * @return [type]                  [description]
     */
    public function updateProfile(ProfileRequest $request)
    {
        auth()->user()->update($request->all());
        return back()->withSuccessMessage('Your profile has been updated.');
    }

    /**
     * Update user's password
     * @param  PasswordRequest $request [description]
     * @return  redirect
     */
    public function updatePassword(PasswordRequest $request)
    {
        auth()->user()->update($request->only('password'));

        return back()->withSuccessMessage('Successfully changed password.');
    }

    /**
     * Handles updating aavatar
     * @param  AavatarRequest $request
     * @return Redirect
     */
    public function updateAavatar(AavatarRequest $request)
    {
        $aavatar = $this->makeAavatarFor(auth()->user(), $request->file('aavatar'));

        auth()->user()->aavatar()->save($aavatar);

        return back()->withSuccessMessage('Your aavatar has been updated.');
    }

    /**
     * Aavatar moves and naming
     * @param  UploadedFile $file
     * @return Aavatar
     */
    protected function makeAavatarFor($user, UploadedFile $file)
    {
        if( $aavatar = $user->aavatar()->first() )
        {
            return $aavatar->removeOldAavatar()
                           ->saveAs($file->getClientOriginalName())
                           ->move($file);
        }

        return Aavatar::named($file->getClientOriginalName())
                        ->move($file);
    }
}
