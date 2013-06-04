<?php
use LaravelBook\Ardent\Ardent;

class Channel extends Ardent {

	const TYPE_EMAIL    = 'email';
	const TYPE_MOBILE   = 'mobile';
	const TYPE_PHONE    = 'phone';
	const TYPE_SKYPE    = 'skype';
	const TYPE_FACEBOOK = 'facebook';
	const TYPE_TWITTER  = 'twitter';

    protected $fillable = array('type', 'value', 'notes');
    protected $guarded = array('id', 'contact_id');
    protected $hidden = array();
    # public $autoHydrateEntityFromInput = true;

    public static $rules = array(	'type' => 'required|in:email,skype,facebook,phone,mobile,twitter',
									'value' => 'required|between:3,50',
									'notes' => '' );

	public function created_at()
	{
		return new Carbon($this->created_at);
	}

	public function contact()
	{
		return $this->belongsTo('Contact');
	}

	public function isEmail()
	{
		return self::TYPE_EMAIL == $this->type;
	}

}
