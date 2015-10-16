<?php
$course = array('Art101', 'Life Drawing', 'Prof. McDonnegal');
$file = 'mycsvfile.txt';
/*
// Open the file to get existing content
$current = file_get_contents($file);
// Append a new person to the file
$current .= "{$course[0]}, $course[1]}, $course[2]}, $course[3]}\n";
// Write the contents back to the file
file_put_contents($file, $current);
*/
$fh = fopen($file, 'a+');
// fputcsv automatically adds enclosures '"' around CSV text elements.
fputcsv($fh, $course);
rewind($fh);
fpassthru($fh);
fclose($fh);