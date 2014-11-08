<?php

Class SectionsController extends BaseController {
	
	public function sectionsPost($SectionId){

		$section = Sections::findOrFail($SectionId);
		return View::make('sections.sections_post')->with('sections', $section);
	
	}
}