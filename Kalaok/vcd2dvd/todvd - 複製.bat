set MPath=%~DP0%..\
set FFMpegPath="%MPath%ffmpeg.exe"
set MPlayerPath="%MPath%mplayer.exe"

%FFMpegPath% -i "D:\KTV\20101125\fix\VTS_08_1.VOB" -i "D:\KTV\20101125\fix\aaa.avs" -map 0:0 -map 1:1 -target ntsc-dvd -vcodec copy -acodec ac3 -ar 48000 -ab 320k -f vob "delay.mpg"