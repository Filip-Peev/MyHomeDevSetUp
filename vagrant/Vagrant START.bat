@echo off

title Vagrant VirtualBox Builder

echo.
echo.
echo.
echo ======================================
echo  Starting Vagrant VirtualBox Build...
echo ======================================
echo.
echo.
echo.
echo When you start this for the first time...
echo.
echo.
echo.
timeout /t 2
echo.
echo.
echo.
echo Go make yourself some coffee! :)
echo.
echo.
echo.
vagrant up
echo.
echo.
echo.
echo =============================================
echo  Alma Linux 10 is up and running with Docker
echo =============================================
echo.
echo.
echo.
timeout /t 2
echo.
echo.
echo.
start http://192.168.0.126/
echo.
echo.
echo.
cmd /k