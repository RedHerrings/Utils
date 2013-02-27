set MPath=%~DP0%..\
set FFMpegPath=%MPath%ffmpeg.exe

rem -ss X: skip 6 secs

"%FFMpegPath%" -i %1 -ss 6 -target ntsc-dvd -acodec copy -vcodec copy -f vob output.mpg

pause