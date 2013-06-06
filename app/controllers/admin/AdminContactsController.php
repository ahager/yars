<?php

class AdminContactsController extends AdminController {

    /**
     * Contact Model
     * @var Contact
     */
    protected $contact;

    protected $user;

    protected $business;

    /**
     * Inject the models.
     * @param User $user
     * @param Role $role
     * @param Permission $permission
     */
    public function __construct(Contact $contact)
    {
        parent::__construct();
        $this->contact = $contact;
        $this->business = Business::getBySlug( Session::get('businessSlug') );
        # if(!$this->business->users->contains(Confide::user()->id)) throw new NotAllowedException; # Moved to beforeFilter
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        $contacts = $this->business->contacts;
        return View::make('admin/contacts/index', compact('contacts'));
    }

    public function getSearch($criteria)
    {
        $contacts = Contact::search($this->business, $criteria);
        return View::make('admin/contacts/index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        return View::make('admin/contacts/create', compact('user'));
    }

    /**
     * User create form processing.
     *
     * @return Redirect
     */
    public function postCreate()
    {
        $contact = Contact::getByFullname( Input::get('last_name'), Input::get('first_name'), $this->business->id );
        if ($contact) 
        {
            return $this->postEdit($contact)->with('warning', trans('admin/contacts/contacts.alert.updated_already_registered'));
        }

        $contact = Contact::getByFullname( Input::get('last_name'), Input::get('first_name'));
        if ($contact)
        {
            $clonedContact = Contact::create($contact->toArray());
            $clonedContact->notes = null;
            if ($clonedContact->save()) {
                $this->business->contacts()->save($clonedContact);
                return Redirect::to('admin/contacts/'.$clonedContact->id.'/show')->with('success', trans('admin/contacts/contacts.alert.cloned'));
            };
            return Redirect::back()->with('errors', $clonedContact->errors() );
        }

        $contact = new Contact;
        $contact->fill(Input::all());

        if ( $contact->save() ) {
            $this->business->contacts()->save($contact);

            return Redirect::to( 'admin/contacts' )->with( 'success', trans('admin/contacts/contacts.alert.registered') );
        } else {
            return Redirect::to( 'admin/contacts/create' )->withErrors( $contact->errors() );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getShow($contact)
    {
        if (!$this->business->contacts->contains($contact->id)) throw new NotAllowedException; # ToDo: Move to a beforeFilter

        return View::make('admin/contacts/show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getEdit($contact)
    {
        if (!$this->business->contacts->contains($contact->id)) throw new NotAllowedException; # ToDo: Move to a beforeFilter

        if ( $contact )
        {
            return View::make('admin/contacts/edit', compact('contact'));
        }
        else
        {
            return Redirect::to('admin/contacts')->with('error', Lang::get('admin/contacts/messages.does_not_exist'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function postEdit($contact)
    {
        if (!$this->business->contacts->contains($contact->id)) throw new NotAllowedException; # ToDo: Move to a beforeFilter
        
        $contact->fill(Input::all());

        if ($contact->save()) {
            // Save Contact Channels
            $contact->channels()->delete();
            foreach (Input::get('channel_value') as $key => $value) {
                $channel = new Channel(
                                        ['value' => Input::get("channel_value.$key"),
                                         'type' => Input::get("channel_type.$key"),
                                         'notes' => Input::get("channel_notes.$key"),   ] );
                $channel->save();
                $contact->channels()->save($channel);
            }
            return Redirect::to('admin/contacts/'.$contact->id.'/show')->with('success', Lang::get('admin/contacts/messages.edit.success'));
        }
        return Redirect::to('admin/contacts/'.$contact->id.'/edit')->with( 'errors', $contact->errors() );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function getDelete($contact)
    {
        if (!$this->business->contacts->contains($contact->id)) throw new NotAllowedException; # ToDo: Move to a beforeFilter
        return View::make('admin/contacts/delete', compact('contact'));
    }

    /**
     * Remove the specified user from storage.
     *
     * @param $user
     * @return Response
     */
    public function postDelete($contact)
    {
        if (!$this->business->contacts->contains($contact->id)) throw new NotAllowedException; # ToDo: Move to a beforeFilter
        $contact->delete();
        return Redirect::to('admin/contacts')->with('success', Lang::get('admin/contacts/messages.delete.ok'));
    }

    public function getLinkUser($contact)
    {
        if (!$this->business->contacts->contains($contact->id)) throw new NotAllowedException; # ToDo: Move to a beforeFilter
        return View::make('admin/contacts/link-user', $view);
    }

    public function postLinkUser($contact)
    {
        if (!$this->business->contacts->contains($contact->id)) throw new NotAllowedException; # ToDo: Move to a beforeFilter

        if ($user = User::findBy('email', Input::get('email')))
        {
            $user->contacts()->save($contact);
            return Redirect::to('admin/contacts')->with('success', Lang::get('admin/contacts/contacts.alert.link_user_ok'));
        }
        return Redirect::back()->with('error', Lang::get('admin/contacts/contacts.alert.link_user_error'));
    }
}