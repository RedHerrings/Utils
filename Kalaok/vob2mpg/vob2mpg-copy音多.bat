set MPath=%~DP0%..\
set FFMpegPath=%MPath%ffmpeg.exe

"%FFMpegPath%" -i %1 -map 0:0 -map 0:1 -map 0:2 -target ntsc-dvd -vcodec copy -acodec copy -f vob output.mpg -acodec copy -newaudio

pause