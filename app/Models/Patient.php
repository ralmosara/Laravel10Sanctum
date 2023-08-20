<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Filters\PatientFilters;
use Essa\APIToolKit\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Patient extends Model
{
    use HasFactory,Filterable;

protected $default_filters = PatientFilters::class;

    /**
     * Mass-assignable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'lastname',
        'firstname',
    ];
}
