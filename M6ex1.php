<?php
// open a file with error checking
// write to the file
// close
// re-open and display the contents

$filePath = '/workspace/exercises/mycsvfile.txt';
if(file_exists($filePath)) {
	echo "File Found.";
	$handle       = fopen($filePath, "r+");
	$fileContents = fread($handle, filesize($filePath));
	fwrite($handle, 'Mike was here');
	fclose($handle);
	if(!empty($fileContents)) {
		echo "<pre>".$fileContents."</pre>";
	}
}
else {
	echo "File Not Found.";
	touch($filePath);
}
