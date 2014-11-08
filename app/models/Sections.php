<?php

class Sections extends Eloquent{
	public function Articles(){
		return $this->hasMany('Articles');
	}
}