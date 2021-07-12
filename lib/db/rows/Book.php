<?php

namespace BerlinDB_Example\DB\Rows;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


class Book extends \BerlinDB\Database\Row {
	use \Underpin\Traits\Templates;

	/**
	 * Book constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param $item
	 */
	public function __construct( $item ) {
		parent::__construct( $item );

		// This is optional, but recommended. Set the type of each column, and prepare.
		$this->id             = (int) $this->id;
		$this->isbn           = (string) $this->isbn;
		$this->title          = (string) $this->title;
		$this->author         = (string) $this->author;
		$this->date_created   = false === $this->date_created ? 0 : strtotime( $this->date_created );
		$this->date_published = false === $this->date_published ? 0 : strtotime( $this->date_published );
	}

	/**
	 * Fetches the valid templates and their visibility.
	 *
	 * override_visibility can be either "theme", "plugin", "public" or "private".
	 *  theme   - sets the template to only be override-able by a parent, or child theme.
	 *  plugin  - sets the template to only be override-able by another plugin.
	 *  public  - sets the template to be override-able anywhere.
	 *  private - sets the template to be non override-able.
	 *
	 * @since 1.0.0
	 *
	 * @return array of template properties keyed by the template name
	 */
	public function get_templates(){
		return [
			'index' => ['override_visibilitiy' => 'public']
		];
	}

	/**
	 * Fetches the template group name. This determines the sub-directory for the templates.
	 *
	 * @since 1.0.0
	 *
	 * @return string The template group name
	 */
	protected function get_template_group(){
		return 'book';
	}

	/**
	 * Retrieves the template group's path. This determines where templates will be searched for within this plugin.
	 *
	 * @since 1.0.0
	 *
	 * @return string The full path to the template root directory.
	 */
	protected function get_template_root_path(){
		return berlindb_example()->template_dir();
	}

}