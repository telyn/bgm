install: 
	mkdir -p /usr/local/bin
	mkdir -p /var/lib/bgm/playlists
	mkdir -p /var/run/bgm
	cp $(CURDIR)/bgm /usr/local/bin/bgm
	cp $(CURDIR)/bgm.service /lib/systemd/system
	systemctl daemon-reload

uninstall:
	rm -rf /usr/local/bin/bgm /var/lib/bgm /var/run/bgm
	rm -f /lib/systemd/system/bgm.service
