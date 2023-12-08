<?php

namespace Msc\MedicalTerms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

/**
 * @class Service
 * @property int                                                                              $id
 * @property int                                                                              $parent_id
 * @property int                                                                              $department_id
 * @property string                                                                           $name
 * @property string                                                                           $description
 * @property string                                                                           $slug
 * @property-read \Illuminate\Database\Eloquent\Collection|\Msc\MedicalTerms\Models\Service[] $children
 * @property-read \Msc\MedicalTerms\Models\Department                                         $department
 *
 */
class Service extends Model
{
    use HasTranslations, HasTranslatableSlug, Searchable;

    /**
     * @var array<string>
     */
    public $translatable = ['name', 'description', 'slug'];

    protected $fillable = [
        'parent_id',
        'department_id',
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
    public function children(): HasMany
    {
        return $this->hasMany(Service::class, 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
