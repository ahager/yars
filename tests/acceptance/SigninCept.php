<?php
$I = new WebGuy($scenario);
$I->wantTo('fail log in as admin user');
$I->amOnPage('/user/login/');
$I->see('Login');
$I->fillField('email','admin');
$I->fillField('password','this-is-a-wrong-password');
$I->click('input[type=submit]'); # Submit the form to try login
$I->see('Error');
$I->see('Login');