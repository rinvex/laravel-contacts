<?php

declare(strict_types=1);

namespace Rinvex\Contacts\Models;

use Illuminate\Database\Eloquent\Model;
use Rinvex\Cacheable\CacheableEloquent;
use Illuminate\Database\Eloquent\Builder;
use Rinvex\Support\Traits\ValidatingTrait;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Rinvex\Contacts\Models\Contact.
 *
 * @property int                                                                             $id
 * @property int                                                                             $entity_id
 * @property string                                                                          $entity_type
 * @property string                                                                          $source
 * @property string                                                                          $method
 * @property string                                                                          $name_prefix
 * @property string                                                                          $first_name
 * @property string                                                                          $middle_name
 * @property string                                                                          $last_name
 * @property string                                                                          $name_suffix
 * @property string                                                                          $title
 * @property string                                                                          $email
 * @property string                                                                          $phone
 * @property string                                                                          $fax
 * @property string                                                                          $skype
 * @property string                                                                          $twitter
 * @property string                                                                          $facebook
 * @property string                                                                          $google_plus
 * @property string                                                                          $linkedin
 * @property string                                                                          $country_code
 * @property string                                                                          $language_code
 * @property string                                                                          $birthday
 * @property string                                                                          $gender
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
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Contacts\Models\Contact whereFacebook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Contacts\Models\Contact whereFax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Contacts\Models\Contact whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Contacts\Models\Contact whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Contacts\Models\Contact whereGooglePlus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Contacts\Models\Contact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Contacts\Models\Contact whereLanguageCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Contacts\Models\Contact whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Contacts\Models\Contact whereLinkedin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Contacts\Models\Contact whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Contacts\Models\Contact whereMiddleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Contacts\Models\Contact whereNamePrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Contacts\Models\Contact whereNameSuffix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Contacts\Models\Contact wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Contacts\Models\Contact whereSkype($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Contacts\Models\Contact whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Contacts\Models\Contact whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Contacts\Models\Contact whereTwitter($value)
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
        'name_prefix',
        'first_name',
        'middle_name',
        'last_name',
        'name_suffix',
        'title',
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
        'title' => 'string',
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
    protected $rules = [
        'entity_id' => 'required|integer',
        'entity_type' => 'required|string|max:150',
        'source' => 'required|string|max:150',
        'method' => 'nullable|string|max:150',
        'name_prefix' => 'nullable|string|max:150',
        'first_name' => 'required|string|max:150',
        'middle_name' => 'nullable|string|max:150',
        'last_name' => 'nullable|string|max:150',
        'name_suffix' => 'nullable|string|max:150',
        'title' => 'nullable|string|max:150',
        'email' => 'nullable|email|min:3|max:150',
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
     * Get the contact name.
     *
     * @return string
     */
    public function getNameAttribute(): string
    {
        return trim(collect([
            $this->name_prefix,
            $this->first_name,
            $this->middle_name,
            $this->last_name,
            $this->name_suffix,
        ])->implode(' '));
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
