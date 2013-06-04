<?php

use Zizaco\Confide\ConfideUser;
use Zizaco\Confide\Confide;
use Zizaco\Entrust\HasRole;
use Robbo\Presenter\PresentableInterface;
use Carbon\Carbon;

class User extends ConfideUser implements PresentableInterface {

    use HasRole;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

    public function getPresenter()
    {
        return new UserPresenter($this);
    }

    /**
     * Get user by username
     * @param $username
     * @return mixed
     */
    public function getUserByUsername( $username )
    {
        return $this->where('username', '=', $username)->first();
    }

    public static function findBy( $field, $key )
    {
        if (in_array($field, ['email','id','nin','last_name']))
        return User::where($field, '=', $key)->first();
    }

    /**
     * Get the date the user was created.
     *
     * @return string
     */
    public function joined()
    {
        return Carbon::create($this->created_at);
    }

    /**
     * Save roles inputted from multiselect
     * @param $inputRoles
     */
    public function saveRoles($inputRoles)
    {
        if(! empty($inputRoles)) {
            $this->roles()->sync($inputRoles);
        } else {
            $this->roles()->detach();
        }
    }

    /**
     * Returns user's current role ids only.
     * @return array|bool
     */
    public function currentRoleIds()
    {
        $roles = $this->roles;
        $roleIds = false;
        if( !empty( $roles ) ) {
            $roleIds = array();
            foreach( $roles as &$role )
            {
                $roleIds[] = $role->id;
            }
        }
        return $roleIds;
    }

    /**
     * Redirect after auth.
     * If ifValid is set to true it will redirect a logged in user.
     * @param $redirect
     * @param bool $ifValid
     * @return mixed
     */
    public static function checkAuthAndRedirect($redirect, $ifValid=false)
    {
        // Get the user information
        $user = Auth::user();
        $redirectTo = false;

        if(empty($user->id) && ! $ifValid) // Not logged in redirect, set session.
        {
            Session::put('loginRedirect', $redirect);
            $redirectTo = Redirect::to('user/login')
                ->with( 'notice', Lang::get('user/user.login_first') );
        }
        elseif(!empty($user->id) && $ifValid) // Valid user, we want to redirect.
        {
            $redirectTo = Redirect::to($redirect);
        }

        return array($user, $redirectTo);
    }

#    public function currentUser()
#    {
#        return (new Confide)->user();
#    }

    public function belongsToBusiness(Business $business)
    {
        return $this->businesses->contains($business->id);
    }

    public function businesses()
    {
        return $this->belongsToMany('Business');
    }

    public function contacts()
    {
        return $this->hasMany('Contact');
    }

    public function getAgeAttribute()
    {
        return (time() - strtotime($this->created_at))/(60*60*24);
    }

    public static function getExisting(Array $data)
    {
        $existingUser = false;
        if (array_key_exists('nin', $data)) $existingUser = User::where('nin', '=', $data['nin']);
        if (!$existingUser && array_key_exists('email', $data)) $existingUser = User::where('email', '=', $data['email']);
        if (!$existingUser && array_key_exists('first_name', $data) && array_key_exists('last_name', $data)) $existingUser = User::where('first_name', '=', $data['first_name'])->where('last_name', '=', $data['last_name']);
        return $existingUser ? $existingUser->first() : false;
    }
}