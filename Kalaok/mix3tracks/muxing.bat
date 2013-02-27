del output.mpg

ffmpeg -fflags -genpts -i video.mpg -i left.ac3 -i right.ac3  -i mix.ac3 -vcodec copy -acodec copy -f vob output.mpg  -target ntsc-dvd -newaudio -target ntsc-dvd -newaudio

pause
