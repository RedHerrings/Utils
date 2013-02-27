set MPath=%~DP0%..\
set FFMpegPath=%MPath%ffmpeg.exe

"%FFMpegPath%" -i %1 -itsoffset 00:00:04 -i %1 -map 0:0 -map 1:1 -acodec copy -vcodec copy -f vob delay.mpg

pause