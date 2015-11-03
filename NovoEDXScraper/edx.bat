@echo off
for /f "tokens=*" %%a in (edxlinks.txt) do call :processline %%a

pause
goto :eof

:processline
echo line=%*
phantomjs edx.js %*

goto :eof

:eof

pause