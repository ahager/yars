<?php

class SiteController extends BaseController {

    /**
     * User Model
     * @var User
     */
    protected $user;

    protected $business;

    /**
     * Inject the models.
     * @param Post $post
     * @param User $user
     */
    public function __construct()
    {
        parent::__construct();

        $this->user = Confide::user();
        $this->business = Business::getBySlug(Session::get('businessSlug'));
    }
    
	/**
	 * Returns all the blog posts.
	 *
	 * @return View
	 */
	public function getIndex()
	{
		// Get all the blog posts
        $businesses = Business::all();
		$contacts = $this->user->contacts;
		// Show the page
		return View::make('site/index', compact('contacts','businesses'));
	}

    public function getReservations()
    {
        $businessSlug = $this->business->slug;
        return 'reservations para '.$businessSlug;
    }

}
