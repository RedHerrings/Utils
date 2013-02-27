set MPath=%~DP0%..\
set FFMpegPath="%MPath%ffmpeg.exe"
set MPlayerPath="%MPath%mplayer.exe"

%FFMpegPath% -i %1 -target ntsc-dvd -acodec ac3 -ar 48000 -ab 256k -b 9000k -f vob %1.mpg

pause