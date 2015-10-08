bgm
===

background music player for linux (will constantly play shuffled music from m3u8 playlists)

dependencies
============

zsh for its sweet read builtin (the -t can be a floating point)
mpg123 to play music

how to install
==============

I'm only gonna give instructions for debian using nginx but really if you're not using debian or nginx I don't care

From a fresh install. systemd-sysv isn't necessary but have fun writing your own init script cause I ain't gonna do it for you. (p.s. pull requests accepted)

	apt-get install nginx php5-fpm mpg123 systemd-sysv zsh
	sudo mkdir -p /var/lib/bgm/playlists /var/run/bgm
	sudo touch /var/run/bgm/playlist
	sudo mkfifo /var/run/bgm/queue
	sudo chown -R www-data:www-data /var/lib/bgm/playlists /var/run/bgm

	git clone https://github.com/telyn/bgm.git
	
	sudo cp bgm/bgm.service /lib/systemd/system # again only if using systemd
	sudo cp bgm/bgm /usr/local/bin
	sudo cp bgm/bgm.php /var/www # or whatever i don't care where your bgm.php goes as long as you know how to get to it from internet

how to use
============

Put playlists in /var/lib/bgm/playlists/ - make damn sure you put a playlist in called background-music.m3u8
All paths in the m3u8s should either be absolute or relative to your music folder. 
The assumption in the code is that the music folder is /music, but it's easy to change - just make sure you do /usr/local/bin/bgm and your bgm.php too.

Test it out by running /usr/local/bin/bgm. If it works, kill it and the mpg123 process and:

	sudo systemctl start bgm.service

It logs what it's doing to /var/log/bgm.log. 

known issues
============

Once every few days it locks up for me and spams "Playing " to the log file, not actually playing anything.
I suspect it's because my network share isn't remounting after network problems.
