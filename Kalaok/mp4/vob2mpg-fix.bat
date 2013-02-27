set MPath=%~DP0%..\
set FFMpegPath=%MPath%ffmpeg.exe

"%FFMpegPath%" -i %1 -vcodec mpeg4 -b 9000 -f mp4 output.mp4

pause