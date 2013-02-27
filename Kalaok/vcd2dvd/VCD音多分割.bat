set MPath=%~DP0%..\
set FFMpegPath="%MPath%ffmpeg.exe"
set MPlayerPath="%MPath%mplayer.exe"

del left.wav right.wav left.ac3 right.ac3 

%MPlayerPath% -vc null -vo null -ao pcm:file=left.wav -af channels=2:2:0:0:0:1 -autosync 30 "%1"
%MPlayerPath% -vc null -vo null -ao pcm:file=right.wav -af channels=2:2:1:0:1:1 -autosync 30 "%1" 

%FFMpegPath% -i left.wav -acodec ac3 -ar 48000 -ab 256k left.ac3
%FFMpegPath% -i right.wav -acodec ac3 -ar 48000 -ab 256k right.ac3

del left.wav right.wav
