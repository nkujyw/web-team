@echo off
setlocal enabledelayedexpansion
chcp 65001 >nul
title web-team 项目一键部署工具

echo ======================================================
echo          web-team 项目一键部署脚本 (XAMPP 版)
echo ======================================================

:: --- 1. 自动寻找 XAMPP 安装路径 ---
set "XAMPP_PATH="
for %%d in (C D E F G) do (
    if exist "%%d:\xampp\xampp-control.exe" (
        set "XAMPP_PATH=%%d:\xampp"
        goto :FOUND_XAMPP
    )
)

:NOT_FOUND
echo [错误] 未能在 C, D, E, F 盘根目录找到 XAMPP。
set /p XAMPP_PATH=请手动输入你的 XAMPP 安装路径 (例如 C:\xampp): 
if not exist "%XAMPP_PATH%\xampp-control.exe" goto :NOT_FOUND

:FOUND_XAMPP
echo [成功] 找到 XAMPP 路径: %XAMPP_PATH%
set "PHP_EXE=%XAMPP_PATH%\php\php.exe"
set "MYSQL_EXE=%XAMPP_PATH%\mysql\bin\mysql.exe"

:: --- 2. 检查项目是否在 htdocs 中 ---
echo %CD% | findstr /i "htdocs" >nul
if errorlevel 1 (
    echo [提醒] 建议将项目文件夹放在 %XAMPP_PATH%\htdocs 下以确保正常访问。
)

:: --- 3. 启动 Apache 和 MySQL 服务 ---
echo [*] 正在静默启动 Apache 和 MySQL...
start /b "" "%XAMPP_PATH%\apache_start.bat" >nul 2>&1
start /b "" "%XAMPP_PATH%\mysql_start.bat" >nul 2>&1

echo [*] 等待数据库启动 (5秒)...
timeout /t 5 /nobreak >nul

:: --- 4. 初始化 Yii2 项目 ---
echo [*] 正在初始化 Yii2 配置文件 (执行 init.bat)...
:: 自动选择开发模式 (Development) 并确认所有覆盖
call init.bat --env=Development --overwrite=All

:: --- 5. 自动创建数据库并导入 SQL ---
set DB_NAME=anti_war_db

echo [*] 正在创建数据库: %DB_NAME%
"%MYSQL_EXE%" -u root -e "CREATE DATABASE IF NOT EXISTS %DB_NAME% DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

if exist "data\install.sql" (
    echo [*] 正在导入数据库文件 data\install.sql...
    "%MYSQL_EXE%" -u root %DB_NAME% < data\install.sql
    echo [成功] 数据库导入完成。
) else (
    echo [警告] 未在 data 文件夹下找到 install.sql，请检查文件是否存在。
)

:: --- 6. 完成提示 ---
:: 获取当前文件夹名称作为 URL 的一部分
for %%I in ("%CD%") do set "FOLDER_NAME=%%~nxI"

echo ======================================================
echo 恭喜！部署任务已尝试完成。
echo.
echo [检查列表]:
echo 1. 数据库名: %DB_NAME% (用户名: root, 密码: 空)
echo 2. 配置文件: common/config/main-local.php 已生成。
echo 3. 访问地址 (假设项目文件夹名为 %FOLDER_NAME%): 
echo    前台: http://localhost/%FOLDER_NAME%/frontend/web/
echo    后台: http://localhost/%FOLDER_NAME%/backend/web/
echo.
echo 注意: 请确保已将该文件夹放置在 XAMPP 的 htdocs 目录下。
echo ======================================================
pause