import mp3play

clip = mp3play.load(r'E:\music.mp3')
clip.play()
try:
	while True:  # dead at here for playing mp3 file, you can press "CTRL+C" to exit
		pass
except KeyboardInterrupt:
	clip.stop()
