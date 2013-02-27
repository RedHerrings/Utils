set MPath=%~DP0%..\
set FFMpegPath=%MPath%ffmpeg.exe

"%FFMpegPath%" -i %1 -ss 6 -target ntsc-dvd -b 9000k -acodec ac3 -ar 48000 -ab 320k -f vob output.mpg

pause