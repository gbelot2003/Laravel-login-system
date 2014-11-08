<?php

Class Articles extends Eloquent{
	
	public function user(){
		return $this->belongsTo('Users', 'users_id');
	}

	Public function sections(){
		return $this->belongsTo('Sections');
	}

}