<?php
/*
Plugin Name: BerlinDB Underpin Example
Description: Example plugin for BerlinDB
Version: 1.0.0
Author: Alex Standiford
Text Domain: berlindb_example
Domain Path: /languages
Requires at least: 5.1
Requires PHP: 7.0
Author URI: https://wpdev.academy
*/

use Underpin\Abstracts\Underpin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Load Underpin, and its dependencies.
$autoload = plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

require_once( $autoload );

/**
 * Fetches the instance of the plugin.
 * This function makes it possible to access everything else in this plugin.
 * It will automatically initiate the plugin, if necessary.
 * It also handles autoloading for any class in the plugin.
 *
 * @since 1.0.0
 *
 * @return \Underpin\Factories\Underpin_Instance The bootstrap for this plugin.
 */
function berlindb_example() {
	return Underpin::make_class( [
		'root_namespace'      => 'BerlinDB_Example',
		'text_domain'         => 'berlindb_example',
		'minimum_php_version' => '7.0',
		'minimum_wp_version'  => '5.1',
		'version'             => '1.0.0',
	] )->get( __FILE__ );
}

// Lock and load.
berlindb_example();

/**
 * Register the Books database model to Underpin.
 * This connects the Table, Schema, and Query class under a single database Model.
 * @see \Underpin_BerlinDB\Abstracts\Database_Model for more information.
 */
berlindb_example()->berlin_db()->add( 'books', [
	'table'             => 'BerlinDB_Example\DB\Tables\Books',
	'schema'            => 'BerlinDB_Example\DB\Schemas\Books',
	'query'             => 'BerlinDB_Example\DB\Queries\Book_Query',
	'name'              => 'Books',
	'description'       => 'Book data, including ISBN and author.',
	'sanitize_callback' => function ( $key, $value ) {
		return $value; //TODO: SET UP SANITIZATION FOR SAVING
	},
] );

/**
 * ADDING RECORDS
 * This snippet shows how records can be added to the database.
 */
add_action( 'init', function () {

	// To reset the DB, uncomment this line
//	berlindb_example()->berlin_db()->reset();

	/**
	 * First, we're going to see if the database already has records. If it does, we'll skip adding these records.
	 * This prevents duplicate records from being created on each page load.
	 * @var $query \BerlinDB_Example\DB\Queries\Book_Query
	 */
	$query = berlindb_example()->berlin_db()->get( 'books' )->query( [
		'number' => 1,    // Only retrieve a single record
		'fields' => 'ids' // Just return an array of IDs. This helps keep our query performant.
	] );


	// If the query didn't find any records, create the records.
	if ( empty( $query->items ) ) {
		$records = [
			[
				'isbn'           => '0-7475-3269-9',
				'title'          => 'Harry Potter and the Philosopher\'s Stone',
				'author'         => 'J.K. Rowling',
				'date_created'   => current_time( 'mysql', true ),
				'date_published' => date( 'Y-m-d H:i:s', strtotime( 'June 26, 1997' ) ),
			],
			[
				'isbn'           => '0-4390-6486-4',
				'title'          => 'Harry Potter and the Chamber of Secrets',
				'author'         => 'J.K. Rowling',
				'date_created'   => current_time( 'mysql', true ),
				'date_published' => date( 'Y-m-d H:i:s', strtotime( 'June 2, 1999' ) ),
			],
			[
				'isbn'           => '0-4396-5548-X',
				'title'          => 'Harry Potter and the Prisoner of Azkaban',
				'author'         => 'J.K. Rowling',
				'date_created'   => current_time( 'mysql', true ),
				'date_published' => date( 'Y-m-d H:i:s', strtotime( 'July 8, 1999' ) ),
			],
			[
				'isbn'           => '0-4391-3959-7',
				'title'          => 'Harry Potter and the Goblet of Fire',
				'author'         => 'J.K. Rowling',
				'date_created'   => current_time( 'mysql', true ),
				'date_published' => date( 'Y-m-d H:i:s', strtotime( 'July 8, 2000' ) ),
			],
			[
				'isbn'           => '0-4393-5807-8',
				'title'          => 'Harry Potter and the Order of the Phoenix',
				'author'         => 'J.K. Rowling',
				'date_created'   => current_time( 'mysql', true ),
				'date_published' => date( 'Y-m-d H:i:s', strtotime( 'June 21, 2003' ) ),
			],
			[
				'isbn'           => '0-4397-8454-9',
				'title'          => 'Harry Potter and the Half-Blood Prince',
				'author'         => 'J.K. Rowling',
				'date_created'   => current_time( 'mysql', true ),
				'date_published' => date( 'Y-m-d H:i:s', strtotime( 'July 16, 2005' ) ),
			],
			[
				'isbn'           => '0-7475-9105-9',
				'title'          => 'Harry Potter and the Deathly Hallows',
				'author'         => 'J.K. Rowling',
				'date_created'   => current_time( 'mysql', true ),
				'date_published' => date( 'Y-m-d H:i:s', strtotime( 'July 21, 2007' ) ),
			],
			[
				'isbn'           => '0-4390-2352-1',
				'title'          => 'The Hunger Games',
				'author'         => 'Suzanne Collins',
				'date_created'   => current_time( 'mysql', true ),
				'date_published' => date( 'Y-m-d H:i:s', strtotime( 'September 14, 2008' ) ),
			],
			[
				'isbn'           => '0-4390-2349-1',
				'title'          => 'Catching Fire',
				'author'         => 'Suzanne Collins',
				'date_created'   => current_time( 'mysql', true ),
				'date_published' => date( 'Y-m-d H:i:s', strtotime( 'September 1, 2009' ) ),
			],
			[
				'isbn'           => '0-4390-2351-3',
				'title'          => 'Mockingjay',
				'author'         => 'Suzanne Collins',
				'date_created'   => current_time( 'mysql', true ),
				'date_published' => date( 'Y-m-d H:i:s', strtotime( 'August 24, 2010' ) ),
			],
		];

		// Loop through and add records
		foreach ( $records as $record ) {
			berlindb_example()->berlin_db()->get( 'books' )->save( $record );
		}
	}
} );

/**
 * QUERYING RECORDS
 * Here's a basic example on how to fetch records from the database.
 * This example hooks into WordPress's the_content, but this could be done anywhere.
 */
add_filter( 'the_content', function ( $content ) {
	/**
	 * Query the database
	 * @var $query \BerlinDB_Example\DB\Queries\Book_Query
	 */
	$query = berlindb_example()->berlin_db()->get( 'books' )->query( [
		'author'  => 'J.K. Rowling',   // Only get books written by J.K Rowling
		'orderby' => 'date_published', // Sort the books by the date they were published
		'order'   => 'asc',            // Use ascending order
	] );

	foreach ( $query->items as $item ) {
		/**
		 * Queried items become instances of Book. This method is declared in our Book class via the template trait.
		 * @see \Underpin\Traits\Templates
		 * @var $item \BerlinDB_Example\DB\Rows\Book
		 */
		echo $item->get_template('index');
	}

	return $content;
} );