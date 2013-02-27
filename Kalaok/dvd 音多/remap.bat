set MPath=%~DP0%..\
set FFMpegPath=%MPath%ffmpeg.exe

"%FFMpegPath%" -i %1 -map 0:0 -map 0:1 -vcodec copy -acodec ac3 -ar 48000 -ab 320k -f vob output.mpg

pause