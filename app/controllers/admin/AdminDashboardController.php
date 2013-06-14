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
		$ownedBusinessesCount = $this->user->businesses()->count();
		if ($ownedBusinessesCount == 0) {
			return Redirect::to('businesses/create')->with('warning', 'admin/dashboard.msg.you_own_no_businesses_yet_create_one');
		}

		$view['businessesCount'] = Business::all()->count();
		$view['myBusinessesCount'] = $ownedBusinessesCount;
		# return var_dump($businesses);
        return View::make('admin/dashboard', $view);
	}

}