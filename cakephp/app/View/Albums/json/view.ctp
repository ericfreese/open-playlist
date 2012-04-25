<album>
	<?php
		$xml = Xml::build($album);
		echo $xml->saveXML();
	?>
</album>