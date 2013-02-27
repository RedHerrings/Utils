set MPath=%~DP0%..\
set FFMpegPath=%MPath%ffmpeg.exe

"%FFMpegPath%" -i %1 -map 0:0 -map 0:1 -vcodec copy -acodec copy -f vob "%1_1.mpg"
"%FFMpegPath%" -i %1 -map 0:0 -map 0:2 -vcodec copy -acodec copy -f vob "%1_2.mpg"

pause