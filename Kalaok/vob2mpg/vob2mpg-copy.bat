set MPath=%~DP0%..\
set FFMpegPath=%MPath%ffmpeg.exe

"%FFMpegPath%" -i %1 -target ntsc-dvd -vcodec copy -acodec copy -f vob output.mpg

pause