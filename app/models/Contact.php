<?php
use LaravelBook\Ardent\Ardent;

class Contact extends Ardent {

    protected $fillable = array('first_name', 'last_name','nin','gender','job','martial_status','postal_address','birthdate','notes','user_id');
    protected $guarded = array('id', 'user_id');
    protected $hidden = array();
    # public $autoHydrateEntityFromInput = true;

    public static $rules = array(	'first_name' => 'required|between:3,50',
									'last_name' => 'required|between:3,50',
									'nin' => 'numeric|max:99999999|min:1000000',
									'gender' => 'in:male,female,unknown',
									'job' => '',
									'martial_status' => '',
									'postal_address' => '',
									'birthdate' => '',
									'notes' => '' );

	public function created_at()
	{
		return new Carbon($this->created_at);
	}

	public function getAgeAttribute()
	{
        # ToDo Use Presenter for dates
		return $this->birthdate == '0000-00-00' ? '' : (new Carbon($this->birthdate))->age;
	}

	public function getUsernameAttribute()
	{
		return $this->user ? $this->user()->first()->username : '';
	}

	public function setNinAttribute($nin)
	{
		$this->attributes['nin'] = $nin == '' ? null : $nin;
	}

	public function setBirthdayAttribute($birthdate)
	{
		$this->attributes['birthdate'] = ($birthdate == '') ? null : $birthdate;
	}

	public function getFullnameAttribute()
	{
		return $this->first_name .' '. $this->last_name;
	}

	public function getInverseFullnameAttribute()
	{
		if ($this->last_name == '') return $this->first_name;
		if ($this->first_name == '') return $this->last_name;
		return $this->last_name .', '. $this->first_name;
	}

    /**
     * Get user by username
     * @param $last_name
     * @param $first_name
     * @return mixed
     */
    public static function getByFullname( $last_name, $first_name = '', $businessId = 1 )
    {
        return self::where('business_id','=',$businessId)->where('last_name', '=', $last_name)->where('first_name', '=', $first_name)->first();
    }

    # ToDo Move to presenter
    public function getEmailAttribute()
    {
    	foreach ($this->channels as $channel) {
    		if ($channel->isEmail()) return $channel->value;
    	}
    	return null;
    }

    public static function search($business, $criteria)
    {
        # ToDo Improve search - This is very basic
    	$result = self::where('business_id','=', $business->id)
    				  ->where('last_name', '=', $criteria)
    				  ->orWhere('first_name', '=', $criteria)
    				  ->orWhere('nin', '=', $criteria)
    				  ->get();
    	return $result;
    }

    public static function getExisting(Business $business, Array $data)
    {
        # ToDo Improve cascade lookup
        $existingUser = false;
        if (array_key_exists('nin', $data))
        	$existingUser = self::where('business_id','=',$business->id)->where('nin', '=', $data['nin']);
        if (!$existingUser && array_key_exists('email', $data))
        	$existingUser = self::where('business_id','=',$business->id)->where('email', '=', $data['email']);
        if (!$existingUser && array_key_exists('first_name', $data) && array_key_exists('last_name', $data))
        	$existingUser = self::where('business_id','=',$business->id)->where('first_name', '=', $data['first_name'])->where('last_name', '=', $data['last_name']);
        return $existingUser ? $existingUser->first() : false;
    }

    ## Relationships ##

    /* Contact is customer of one Business */
    public function business()
    {
        return $this->belongsTo('Business');
    }

    /* Contact has none, one or many communication Channels */
    public function channels()
    {
        return $this->hasMany('Channel');
    }

    /* Contact information represents a person who may be or not a registered User */ 
    public function user()
    {
        return $this->belongsTo('User');
    }
}
