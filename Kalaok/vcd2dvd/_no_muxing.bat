set MPath=%~DP0%..\
set FFMpegPath="%MPath%ffmpeg.exe"
set MPlayerPath="%MPath%mplayer.exe"

del "%1.mpg"

%FFMpegPath% -fflags -genpts -i "%1" -i left.ac3 -i right.ac3 -map 0:0 -map 1:0 -map 2:0 -target ntsc-dvd -acodec copy -b 9000k -f vob "%1.mpg" -target ntsc-dvd -newaudio 
pause
