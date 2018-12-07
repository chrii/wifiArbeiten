<?php
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept' );
 echo file_get_contents( 'https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml' );
