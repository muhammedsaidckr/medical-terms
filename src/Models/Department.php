<?php

namespace Msc\MedicalTerms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

/**
 * @class Department
 * @property int                                                                              $id
 * @property string                                                                           $name
 * @property string                                                                           $description
 * @property string                                                                           $slug
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Msc\MedicalTerms\Models\Service[] $services
 * @property-read \Illuminate\Database\Eloquent\Collection|\Msc\MedicalTerms\Models\Service[] $parentServices
 * @property-read \Illuminate\Database\Eloquent\Collection|\Msc\MedicalTerms\Models\Symptom[] $symptoms
 */
class Department extends Model
{
    use HasTranslations, HasTranslatableSlug, Searchable;

    /**
     * @var array<string>
     */
    public $translatable = ['name', 'description', 'slug'];

    protected $fillable = [
        'name',
        'description',
        'slug'
    ];

    /**
     * @return \Spatie\Sluggable\SlugOptions
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    /** @return \Illuminate\Database\Eloquent\Relations\HasMany */
    public function parentServices(): HasMany
    {
        return $this->services()->whereNull('parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function symptoms(): HasMany
    {
        return $this->hasMany(Symptom::class);
    }
}
