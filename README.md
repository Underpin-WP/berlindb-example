# Underpin BerlinDB Example

This is an example plugin that shows you how to create a `Books` table in MySQL using BerlinDB and Underpin. It is based
on the [WordPress Example](https://github.com/berlindb/wordpress-example) repostiory.

This plugin is intended for you to clone, hack, and learn how BerlinDB works with Underpin.

**Important** - You should only run this repository on a non-production environment!

## To Use:

1. Clone this repository in your WordPress install's `plugins` directory
1. Run `composer install`
1. Activate this plugin
1. Visit a single post

You will see that the post content is replaced with a list of Harry Potter books, in order of publish.

From here, you can tinker with the query, the files that get saved, and everything else inside of the `bootstrap.php`
file. There are many comments in this file, and should help