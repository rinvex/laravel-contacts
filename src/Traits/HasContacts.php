<?php

declare(strict_types=1);

namespace Rinvex\Contacts\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasContacts
{
    /**
     * Register a deleted model event with the dispatcher.
     *
     * @param \Closure|string $callback
     *
     * @return void
     */
    abstract public static function deleted($callback);

    /**
     * Define a polymorphic one-to-many relationship.
     *
     * @param string $related
     * @param string $name
     * @param string $type
     * @param string $id
     * @param string $localKey
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    abstract public function morphMany($related, $name, $type = null, $id = null, $localKey = null);

    /**
     * Boot the HasContacts trait for the model.
     *
     * @return void
     */
    public static function bootHasContacts()
    {
        static::deleted(function (self $model) {
            $model->contacts()->delete();
        });
    }

    /**
     * Get all attached contacts to the model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function contacts(): MorphMany
    {
        return $this->morphMany(config('rinvex.contacts.models.contact'), 'entity');
    }
}
