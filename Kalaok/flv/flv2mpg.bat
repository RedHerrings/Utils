set MPath=%~DP0%..\
set FFMpegPath=%MPath%ffmpeg.exe

"%FFMpegPath%" -i %1 -target ntsc-dvd -acodec ac3 -ar 48000 -ab 256k -f vob %1.mpg

pause