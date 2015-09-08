<?php

namespace Banijya;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['name','user_id', 'subject_type', 'subject_id'];

    /**
 * get the user responsible for the given activity.
 */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

     /**
     * Get the subject of the activity.
     *
     * @return mixed
     */
    public function subject()
    {
        return $this->morphTo();
    }
}
