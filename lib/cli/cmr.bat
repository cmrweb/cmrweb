@echo off 
set /p cmr="cmr "
REM Change Directory to the folder containing your script
CD C:\wamp64\www\cmrweb\lib\cli
REM Execute
php cmr.php %cmr%