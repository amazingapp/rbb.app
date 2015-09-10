<?php

namespace Banijya;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    protected $fillable = [
                        'name', 'email', 'password',
                        'employee_id', 'mobile',
                        'dob','designation','current_branch',
                        'login_count'
                        ];

        /**
         * The attributes excluded from the model's JSON form.
         *
         * @var array
         */
        protected $hidden = ['password', 'remember_token','login_count','created_at','updated_at','avatar','settings'];

        protected $casts = [
                'settings' => 'json'
        ];

    /**
     * A User can have many posts
     * @return
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }


    /**
     * User can have many comments
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * User have an Aavatar
     * @return HasMany
     */
    public function aavatar()
    {
        return $this->hasOne(Aavatar::class, 'user_id');
    }
    /**
     * Get the activity timeline for the user
     */
    public function activity()
    {
        return $this->hasMany(Activity::class)
                 // ->with(['subject.status'])
                 ->latest();
    }

    /**
     * Default behaviour for password setting
     * @param $value
     */
    public function setPasswordAttribute( $value )
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Get the friends of the current user
     * @return
     */
    public function friendsOfMine()
    {
        return $this->belongsToMany(User::class, 'friends',
             'user_id',
             'friend_id'
            )->withTimestamps();
    }

    /**
     * Is the user is friend of other friend
     * @return
     */
    public function friendOf()
    {
        return $this->belongsToMany(User::class,
                'friends',
                'friend_id',
                'user_id')->withTimestamps();
    }

    /**
     * List of Acceptec friends
     * @return
     */
    public function friends()
    {
        return $this->friendsOfMine()->wherePivot('accepted',true)
                ->get()->merge(
                            $this->friendOf()->wherePivot('accepted', true)->get()
                        );
    }

    /**
     * Check if the user has friends request
     * @return [type] [description]
     */
    public function friendsRequests()
    {
        return $this->friendsOfMine()->wherePivot('accepted',false);
    }


    public function friendRequestsPending()
    {
        return $this->friendOf()->wherePivot('accepted', false);
    }

    public function hasFriendRequestPending(User $user)
    {
        return (bool) $this
                    ->friendRequestsPending()
                    ->get()
                    ->where('id', $user->id)->count();
    }


    public function hasFriendRequestReceived(User $user)
    {
        // dd($this->friendsRequests()->get()->where('id',1));
        return (bool) $this->friendsRequests()
                        ->get()
                        ->where('id',$user->id) // we are querying the collection now
                        ->count();
    }


    /**
     * Add a user
     * @param User $user
     */
    public function addFriend(User $user)
    {
        return $this->friendOf()->attach($user);
    }

    /**
     * Delete User of any type, pending, requested, or accepted
     * @return
     */
    public function deleteFriend(User $user)
    {
        $this->friendsOfMine()->detach($user); // basically both will detach the user
        $this->friendOf()->detach($user);
    }

    public function acceptFriendRequest(User $user)
    {
        return $this->friendsRequests()->get()
                    ->where('id', $user->id)
                    ->first()
                    ->pivot
                    ->update([
                            'accepted' => true
                        ]);
    }

    /**
     * Check to see if the given user is connected in any way possible
     * @param      $user
     * @return     boolean
     */
    public function isConnectedWith(User $user)
    {
          $user = $this->friendsOfMine()->wherePivot('friend_id',$user->id)
                            ->get()->merge(
                                $this->friendOf()->wherePivot('friend_id', $user->id)->get()
                        );
        return (bool) $user->count();
    }


    public function isFriendsWith(User $user)
    {
        return (bool) $this->friends()
                        ->where('id', $user->id)
                        ->count();
    }
}
