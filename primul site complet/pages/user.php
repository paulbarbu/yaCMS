<p>
<ul>
	<?php
	echo '<li> You are currently on: ' ,$_SERVER['SERVER_NAME'], '</li>' ,PHP_EOL,
		'<li> Your IP:PORT: ' ,$_SERVER['REMOTE_ADDR'], '</li>' ,PHP_EOL,
		'<li> Port on wich the connection was established: ' ,$_SERVER['REMOTE_PORT'], '</li>' ,PHP_EOL;
	?>
</ul>
</p>