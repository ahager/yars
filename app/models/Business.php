<?php
use LaravelBook\Ardent\Ardent;

class Business extends Ardent {
    
    protected $guarded = array('id');
    protected $fillable = array('name', 'website', 'slug', 'description', 'location', 'phone');

    public static $rules = array(
    							'slug' => 'required|min:3|max:30|unique:businesses,slug',
    							'name' => 'required|min:3|max:50',
                                'description' => '',
                                'location' => '',
                                'phone' => '',
    							'website' => 'url',
    						);

    public function users()
    {
    	return $this->belongsToMany('User');
    }

    public function contacts()
    {
        return $this->hasMany('Contact');
    }

    public static function getBySlug($slug)
    {
        return self::where('slug', '=', $slug)->first();
    }

    public function setSlugAttribute($slug)
    {
        $this->attributes['slug'] = ( '' == trim($slug) ) ? Str::slug(trim($this->name)) : Str::slug($slug);
    }

    public function getSlugAttribute()
    {
        return $this->attributes['slug'];
    }

}

