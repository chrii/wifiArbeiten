<?php
  header( 'Access-Control-Allow-Origin: *' );
  header( 'Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept' );

?>
<?php if ( $_GET['page'] == 'A' ) { ?>
<h1>Seite A</h1>
<p>Hier kommt Text</p>
<?php } else if ( $_GET['page'] == 'B' ) { ?>
<h1>Seite B</h1>
<p>Hier kommt Text</p>
<p><a href="http://localhost/js/server/a.php">A</a></p>
<?php } else {
}?>
