dropzone
don't forget to edit php.ini file
Image operations tend to be quite memory exhausting because image handling libraries usually 'unpack' all the pixels to memory. A JPEG file of 3MB can thus easily grow to 60MB in memory and that's when you've probably hit the memory limit allocated for PHP.

As far I remember, XAMP only allocates 128 MB RAM for PHP.

Check your php.ini and increase the memory limit, e.g.:

memory_limit = 512MB