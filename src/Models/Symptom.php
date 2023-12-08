<?php

namespace Msc\MedicalTerms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

/**
 * @class Symptom
 * @property int                                      $id
 * @property string                                   $name
 * @property string                                   $description
 * @property string                                   $slug
 * @property int                                      $department_id
 * @property-read \Msc\MedicalTerms\Models\Department $department
 */
class Symptom extends Model
{
    use HasTranslations, HasTranslatableSlug, Searchable;

    public $translatable = ['name', 'description', 'slug'];

    protected $fillable = [
        'department_id',
        'name',
        'description',
        'slug'
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
