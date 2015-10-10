<?php

define('RUNDIR', '/var/run/bgm');
define('LIBDIR', '/var/lib/bgm');
define('PLAYLISTS_DIR', LIBDIR.'/playlists');
define('QUEUE', RUNDIR.'/queue');
define('CURRENT_PLAYLIST', RUNDIR.'/playlist');

header('Content-Type: text/plain');

switch($_GET['mode']) {
case 'get-playlist':
    print file_get_contents(CURRENT_PLAYLIST);
    break;

case 'set-playlist':
    $fh = fopen(CURRENT_PLAYLIST,'w');
    fwrite($fh, $_GET['playlist']);
    fclose($fh);
    break;

case 'add-queue':
    $fh = fopen(QUEUE, 'a');
    foreach($_GET['mp3'] as $i => $mp3) {
	fwrite($fh, $mp3 . "\r\n");
    }
    fclose($fh);
    break;

case 'get-playlists':
    $dh = opendir(PLAYLISTS_DIR);
    while($pl = readdir($dh)) {
	if(substr($pl,0,1) == '.') {
	    continue;
	}
	print substr($pl, 0, strpos($pl, '.'))."\r\n";
    }
    break;
case 'get-song':
    print file_get_contents(RUNDIR.'/current-song');
    break;
}

?>
