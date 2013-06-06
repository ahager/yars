<?php

class AdminBusinessesController extends AdminController {

    protected $user;

    public function __construct()
    {
        $this->user = Confide::user();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        // Grab all the businesses
        # $businesses = Confide::user()->businesses;
        $businesses = $this->user->businesses;
        // Show the page
        return View::make('admin/businesses/index', compact('businesses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        return View::make('admin/businesses/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate()
    {
        $business = new Business(['name'=>Input::get('name'), 'slug'=>Input::get('slug'), 'website'=>Input::get('website')]);
        # $business->fill(Input::all());
        # $business->slug = Str::slug(Input::get('slug'));

        if ( $business->save() ) {

            $this->user->businesses()->save($business);

            return Redirect::to( 'admin/businesses' )->with( 'success', trans('msg.success.created') );
        } else {
            return Redirect::to( 'admin/businesses/create' )->with( 'errors', $business->errors() );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getEdit($business)
    {
        # if (!$this->user->businesses->contains($business->id)) throw new NotAllowedException; # Moved to beforeFilter

        Former::populate($business);
        return View::make('admin/businesses/edit', compact($business));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function postEdit($business)
    {
        # if (!$this->user->businesses->contains($business->id)) throw new NotAllowedException; # Moved to beforeFilter

        $business->fill(Input::all());

        $business->save(['slug'=>'unique:businesses,slug,'.$business->id]);
        return Redirect::to('admin/businesses/index')->with('success', 'edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}