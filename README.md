simpleTGP
=========

A simple TGP script to generate your own TGP gallery for Windows.
(tested on win7)

Usage
=======

1. File structure should look like:


```
#!php

/apache/
/thumbs/
/generator/
generator.bat
generator.php
index.php
your_video1.mkv
your_video2.avi
your_video3.avi
your_video4.mp4
```

2. Start apache2 by running /apache/ASTART.bat
3. Run thumbnail generator by first visiting localhost:8800/generator.php (this file will create necessary bat lines) and then executing /generator.bat . Once is done, it will automatically close, so just wait.
4. Visit localhost:8800 and have fun, run /apache/ASTOP.bat when finished


Requirements
==========
- Webbrowser
- VLC player + VLC Plugin for browsers