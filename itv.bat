@echo off
chcp 65001 >nul
setlocal enabledelayedexpansion

:: 1. 检查是否具有管理员权限
net session >nul 2>&1
if %errorLevel% neq 0 (
    echo 需要管理员权限执行此脚本。
    powershell -Command "Start-Process cmd -ArgumentList '/c \"%~fnx0\"' -Verb RunAs"
    exit /b
)
echo 正在解析域名：itv.dns.52top.com.cn
echo.

:: 2. 获取 itv.dns.52top.com.cn 的 IP 地址
for /f "tokens=2 delims=[]" %%A in ('ping -n 1 itv.dns.52top.com.cn ^| find "["') do set IP=%%A

echo 解析得到的 IP 地址: %IP%
if "%IP%"=="" (
    echo 无法获得有效IP地址，请检查域名（itv.dns.52top.com.cn）是否可用。
    echo.
    echo 按任意键退出本窗口...
    pause >nul
    exit /b
)

:: 3. 定义 hosts 文件路径
set HOSTS_FILE=%SystemRoot%\System32\drivers\etc\hosts
set TEMP_FILE=%TEMP%\hosts_filtered.txt

:: 4. 先删除旧的相关记录（不区分 IP）
findstr /V /R /C:"cache.ott.ystenlive.itv.cmvideo.cn" ^
               /C:"cache.ott.bestlive.itv.cmvideo.cn" ^
               /C:"cache.ott.wasulive.itv.cmvideo.cn" ^
               /C:"cache.ott.fifalive.itv.cmvideo.cn" ^
               /C:"cache.ott.hnbblive.itv.cmvideo.cn" %HOSTS_FILE% > %TEMP_FILE%

:: 5. 添加新的 IP 记录
(
    echo %IP% cache.ott.ystenlive.itv.cmvideo.cn
    echo %IP% cache.ott.bestlive.itv.cmvideo.cn
    echo %IP% cache.ott.wasulive.itv.cmvideo.cn
    echo %IP% cache.ott.fifalive.itv.cmvideo.cn
    echo %IP% cache.ott.hnbblive.itv.cmvideo.cn
) >> %TEMP_FILE%

:: 6. 覆盖原 hosts 文件
copy /Y %TEMP_FILE% %HOSTS_FILE% >nul

:: 7. 清理临时文件
del %TEMP_FILE%

echo.
echo HOSTS文件已更新完成，可尝试观看ITV。
echo.
echo 按任意键退出本窗口...
pause >nul

endlocal
