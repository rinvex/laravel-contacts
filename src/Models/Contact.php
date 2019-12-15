<?php

declare(strict_types=1);

namespace Rinvex\Contacts\Models;

use Illuminate\Database\Eloquent\Model;
use Rinvex\Cacheable\CacheableEloquent;
use Illuminate\Database\Eloquent\Builder;
use Rinvex\Contacts\Events\ContactCreated;
use Rinvex\Contacts\Events\ContactDeleted;
use Rinvex\Support\Traits\ValidatingTrait;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Rinvex\Contacts\Models\Contact.
 *
 * @property int                                                                             $id
 * @property int                                                                             $entity_id
 * @property string                                                                          $entity_type
 * @property string                                                                          $given_name
 * @property string                                                                          $family_name
 * @property string                                                                          $full_name
 * @property string                                                                          $title
 * @property string                                                                          $organization
 * @property string                                                                          $email
 * @property string                                                                          $phone
 * @property string                                                                          $fax
 * @property string                                                                          $country_code
 * @property string                                                                          $language_code
 * @property string                                                                          $birthday
 * @property string                                                                          $gender
 * @property string                                                                          $national_id_type
 * @property string                                                                          $national_id
 * @property string                                                                          $source
 * @property string                                                                          $method
 * @property string                                                                          $notes
 * @property \Carbon\Carbon|null                                                             $created_at
 * @property \Carbon\Carbon|null                                                             $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Rinvex\Contacts\Models\Contact[] $backRelatives
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent                              $entity
 * @property-read string                                                                     $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\Rinvex\Contacts\Models\Contact[] $relatives
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Contacts\Models\Contact country($countryCode)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Contacts\Models\Contact language($languageCode)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Contacts\Models\Contact method($method)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Contacts\Models\Contact source($source)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Contacts\Models\Contact whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Contacts\Models\Contact whereCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Contacts\Models\Contact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Contacts\Models\Contact whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Contacts\Models\Contact whereEntityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Contacts\Models\Contact whereEntityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Contacts\Models\Contact whereFax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Contacts\Models\Contact whereFamilyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Contacts\Models\Contact whereGivenName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Contacts\Models\Contact whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Contacts\Models\Contact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Contacts\Models\Contact whereLanguageCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Contacts\Models\Contact whereNationalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Contacts\Models\Contact whereNationalIdType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Contacts\Models\Contact whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Contacts\Models\Contact whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Contacts\Models\Contact whereOrganization($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Contacts\Models\Contact wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Contacts\Models\Contact whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Contacts\Models\Contact whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Contacts\Models\Contact whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
        'given_name',
        'family_name',
        'title',
        'organization',
        'email',
        'phone',
        'fax',
        'country_code',
        'language_code',
        'birthday',
        'gender',
        'national_id_type',
        'national_id',
        'source',
        'method',
        'notes',
    ];

    /**
     * {@inheritdoc}
     */
    protected $casts = [
        'entity_id' => 'integer',
        'entity_type' => 'string',
        'given_name' => 'string',
        'family_name' => 'string',
        'title' => 'string',
        'organization' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'fax' => 'string',
        'country_code' => 'string',
        'language_code' => 'string',
        'birthday' => 'string',
        'gender' => 'string',
        'national_id_type' => 'string',
        'national_id' => 'string',
        'source' => 'string',
        'method' => 'string',
        'notes' => 'string',
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
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => ContactCreated::class,
        'deleted' => ContactDeleted::class,
    ];

    /**
     * The default rules that the model will validate against.
     *
     * @var array
     */
    protected $rules = [
        'entity_id' => 'required|integer',
        'entity_type' => 'required|string|max:150',
        'given_name' => 'required|string|max:150',
        'family_name' => 'nullable|string|max:150',
        'title' => 'nullable|string|max:150',
        'organization' => 'nullable|string|max:150',
        'email' => 'nullable|email|min:3|max:150',
        'phone' => 'nullable|numeric|phone',
        'fax' => 'nullable|string|max:150',
        'country_code' => 'nullable|alpha|size:2|country',
        'language_code' => 'nullable|alpha|size:2|language',
        'birthday' => 'nullable|date_format:Y-m-d',
        'gender' => 'nullable|in:male,female',
        'national_id_type' => 'nullable|in:identification,passport,other',
        'national_id' => 'nullable|string|max:150',
        'source' => 'nullable|string|max:150',
        'method' => 'nullable|string|max:150',
        'notes' => 'nullable|string|max:10000',
    ];

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
    }

    /**
     * Get the owner model of the contact.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function entity(): MorphTo
    {
        return $this->morphTo('entity', 'entity_type', 'entity_id');
    }

    /**
     * Enforce clean sources.
     *
     * @param string $value
     *
     * @return void
     */
    public function setSourceAttribute($value): void
    {
        $this->attributes['source'] = str_slug($value);
    }

    /**
     * Enforce clean methods.
     *
     * @param string $value
     *
     * @return void
     */
    public function setMethodAttribute($value): void
    {
        $this->attributes['method'] = str_slug($value);
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
     * Get full name attribute.
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return implode(' ', [$this->given_name, $this->family_name]);
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
