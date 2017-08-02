<?php

declare(strict_types=1);

namespace Rinvex\Contacts;

use Watson\Validating\ValidatingTrait;
use Illuminate\Database\Eloquent\Model;
use Rinvex\Cacheable\CacheableEloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Contact extends Model
{
    use ValidatingTrait;
    use CacheableEloquent;

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'entity_id',
        'entity_type',
        'source',
        'method',
        'name_prefix',
        'first_name',
        'middle_name',
        'last_name',
        'name_suffix',
        'job_title',
        'email',
        'phone',
        'fax',
        'skype',
        'twitter',
        'facebook',
        'google_plus',
        'linkedin',
        'country_code',
        'language_code',
        'birthday',
        'gender',
    ];

    /**
     * {@inheritdoc}
     */
    protected $casts = [
        'entity_id' => 'integer',
        'entity_type' => 'string',
        'source' => 'string',
        'method' => 'string',
        'name_prefix' => 'string',
        'first_name' => 'string',
        'middle_name' => 'string',
        'last_name' => 'string',
        'name_suffix' => 'string',
        'job_title' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'fax' => 'string',
        'skype' => 'string',
        'twitter' => 'string',
        'facebook' => 'string',
        'google_plus' => 'string',
        'linkedin' => 'string',
        'country_code' => 'string',
        'language_code' => 'string',
        'birthday' => 'string',
        'gender' => 'string',
        'deleted_at' => 'datetime',
    ];

    /**
     * {@inheritdoc}
     */
    protected $observables = [
        'validating',
        'validated',
    ];

    /**
     * The default rules that the model will validate against.
     *
     * @var array
     */
    protected $rules = [];

    /**
     * Whether the model should throw a
     * ValidationException if it fails validation.
     *
     * @var bool
     */
    protected $throwValidationExceptions = true;

    /**
     * Create a new Eloquent model instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config('rinvex.contacts.tables.contacts'));
        $this->setRules([
            'entity_id' => 'required|integer',
            'entity_type' => 'required|string|max:150',
            'source' => 'nullable|string|max:150',
            'method' => 'nullable|string|max:150',
            'name_prefix' => 'nullable|string|max:150',
            'first_name' => 'nullable|string|max:150',
            'middle_name' => 'nullable|string|max:150',
            'last_name' => 'nullable|string|max:150',
            'name_suffix' => 'nullable|string|max:150',
            'job_title' => 'nullable|string|max:150',
            'email' => 'nullable|email|min:3|max:150|unique:'.config('rinvex.fort.tables.users').',email',
            'phone' => 'nullable|numeric|min:4',
            'fax' => 'nullable|string|max:150',
            'skype' => 'nullable|string|max:150',
            'twitter' => 'nullable|string|max:150',
            'facebook' => 'nullable|string|max:150',
            'google_plus' => 'nullable|string|max:150',
            'linkedin' => 'nullable|string|max:150',
            'country_code' => 'nullable|alpha|size:2|country',
            'language_code' => 'nullable|alpha|size:2|language',
            'birthday' => 'nullable|date_format:Y-m-d',
            'gender' => 'nullable|string|in:m,f',
        ]);
    }

    /**
     * Get the owner model of the contact.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function entity(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Enforce clean sources.
     *
     * @param string $value
     *
     * @return void
     */
    public function setSourceAttribute($value)
    {
        $this->attributes['source'] = str_slug($value, '_');
    }

    /**
     * Enforce clean methods.
     *
     * @param string $value
     *
     * @return void
     */
    public function setMethodAttribute($value)
    {
        $this->attributes['method'] = str_slug($value, '_');
    }

    /**
     * Scope contacts by the given country.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param string                                $countryCode
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCountry(Builder $builder, string $countryCode): Builder
    {
        return $builder->where('country_code', $countryCode);
    }

    /**
     * Scope contacts by the given language.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param string                                $languageCode
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLanguage(Builder $builder, string $languageCode): Builder
    {
        return $builder->where('language_code', $languageCode);
    }

    /**
     * Scope contacts by the given source.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param string                                $source
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSource(Builder $builder, string $source): Builder
    {
        return $builder->where('source', $source);
    }

    /**
     * Scope contacts by the given method.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param string                                $method
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMethod(Builder $builder, string $method): Builder
    {
        return $builder->where('method', $method);
    }

    /**
     * A contact may have multiple related contacts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function relatives(): BelongsToMany
    {
        return $this->belongsToMany(self::class, config('rinvex.contacts.tables.contact_relations'), 'contact_id', 'related_id')
                    ->withPivot('relation')->withTimestamps();
    }

    /**
     * A contact may be related to multiple contacts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function backRelatives(): BelongsToMany
    {
        return $this->belongsToMany(self::class, config('rinvex.contacts.tables.contact_relations'), 'related_id', 'contact_id')
                    ->withPivot('relation')->withTimestamps();
    }
}
