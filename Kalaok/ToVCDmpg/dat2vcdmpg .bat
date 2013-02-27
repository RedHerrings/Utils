set MPath=%~DP0%..\
set FFMpegPath=%MPath%ffmpeg.exe

"%FFMpegPath%" -i "%1" -target ntsc-vcd -acodec copy -vcodec copy -async 2 "%1.mpg"
