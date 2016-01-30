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
                        'login_count','remember_token'
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
     * Find Employee or Throw Exception
     * @param  [type] $scope      [description]
     * @param  [type] $employeeId [description]
     * @return [type]             [description]
     */
    public function scopefindByEmployeeId($query, $employeeId)
    {
        return $query->where('employee_id','=', $employeeId)->firstOrFail();
    }


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
     * User Have an Image
     * @return HasOne
     */
    public function image()
    {
        return $this->aavatar();
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
        return !! $user->count();
    }


    public function isFriendsWith($userId)
    {
        if($userId instanceof User)
        {
            $userId = $userId->id;
        }

        return !! $this->friends()
                        ->where('id', $userId)
                        ->count();
    }

    /**
     * Get all Friends of Mine
     * @return Query
     */
    public function scopeAllFriends($query)
    {
        $user = $this;

        return $query->join('friends', function ($join)
        {
            $join->on("users.id", '=', 'friends.user_id')
            ->orOn('users.id', '=', 'friends.friend_id')
            ->where('friends.accepted','=', 1);
        })
        ->join('images', 'images.user_id','=','users.id')
        ->where(function($query) use ($user){
            $query
            ->orWhere('friends.user_id', $this->id)
            ->orWhere('friends.friend_id', $this->id);
        })
        ->where('users.id', '<>', $this->id)
        ->groupBy('users.id')
        ->select(['users.*', 'images.thumbnail_path','images.path as image_path']);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Record Activity for the User
     * @param   $action
     * @param   $related
     * @return  Activity
     */
    public function recordActivity( $action , $related )
    {
        if( ! method_exists($related, 'recordActivity') )
        {
            throw new \Exception('Method recordActivity does not exists.');
        }
        return $related->recordActivity($action, $this->id);
    }
}
