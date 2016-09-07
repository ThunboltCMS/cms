<?php

namespace App\Renderers;

interface ITemplateFormRenderer {

	/**
	 * @param string $file
	 * @return TemplateFormRenderer
	 */
	public function create($file);

}
