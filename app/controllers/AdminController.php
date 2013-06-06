<?php

class AdminController extends BaseController {

    /**
     * Initializer.
     *
     * @return \AdminController
     */
    public function __construct()
    {
        parent::__construct();
        # Apply the admin auth filter
        $this->beforeFilter('admin-auth');
        # Check the Business ownership before going admin
        $this->beforeFilter('business');
    }

}