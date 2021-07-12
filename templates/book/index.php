<?php

// bail early if template is invalid
if( !isset($template) || !$template instanceof \BerlinDB_Example\DB\Rows\Book){
	return;
}

?>
<h3><?= $template->title ?></h3>
<dl>
	<dt>Author: </dt><dd><?= $template->author ?></dd>
	<dt>ISBN: </dt><dd><?= $template->isbn ?></dd>
	<dt>Published: </dt><dd><?= date( 'M d, Y', $template->date_published ) ?></dd>
</dl>