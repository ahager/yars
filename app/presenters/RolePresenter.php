<?php

use Robbo\Presenter\Presenter;

class RolePresenter extends Presenter
{
	public function presentName()
	{
		return trans('roles.'.$this->name);
	}
}