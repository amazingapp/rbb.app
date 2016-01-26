<?php

namespace Banijya\Traits;

use Banijya\Activity;
use Banijya\User;
use ReflectionClass;
use Auth;

trait CanBeActivity {

    protected static function bootCanBeActivity()
    {
        $authId = Auth::id();

        foreach(static::getModelEvents() as $event)
        {
            static::$event(function($model) use ($event, $authId) {
                $model->recordActivity($event, $authId);
            });
        }
    }

    /**
     * Add Activity
     * @param $event
     * @param null $userID
     * @internal param User $user
     */
    public function recordActivity($event , $userID)
    {
        Activity::create([
            'subject_id'   => $this->id,
            'subject_type' => get_class($this),
            'name'         => $this->getActivityName( $this , $event ),
            'user_id'      => $userID?:$this->user_id
        ]);
    }


    /**
     * Get Model Events
     * @return array
     */
    protected static function getModelEvents()
    {
        if( isset(static::$recordsEvents) )
        {
            return static::$recordsEvents;
        }

        return ['created', 'deleted', 'updated'];
    }

    /**
     * get the activity name
     * @param $model
     * @param $action
     * @return string
     */
    protected function getActivityName($model, $action)
    {
        $name = strtolower((new ReflectionClass($model))->getShortName());

        return "{$action}_{$name}";
    }
}