<?php

class AdminDashboardController extends AdminController {

	protected $user;

	protected $currentBusiness;

	public function __construct()
    {
        parent::__construct();
        $this->user = Confide::user();
        $this->currentBusiness = Business::getBySlug( Session::get('businessSlug') );
    }
	/**
	 * Admin dashboard
	 *
	 */
	public function getIndex()
	{
		$view['businessesCount'] = Business::all()->count();
		$view['myBusinessesCount'] = $this->user->businesses()->count();
		# return var_dump($businesses);
        return View::make('admin/dashboard', $view);
	}

}