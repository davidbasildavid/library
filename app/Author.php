<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Author extends Model
{
	protected $guarded = [];

	protected $date = ['dob'];

	public function setDobAttribute($dob)
	{
		$this->attributes['dob'] = Carbon::parse($dob);
	}
}
