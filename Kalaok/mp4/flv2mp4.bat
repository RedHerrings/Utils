set MPath=%~DP0%..\
set FFMpegPath=%MPath%ffmpeg.exe

"%FFMpegPath%" -i %1 -vcodec copy -acodec copy -f mp4 %1.mp4

pause