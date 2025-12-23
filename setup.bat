@echo off
setlocal enabledelayedexpansion
chcp 65001 >nul
title web-team 项目一键部署工具 v6.9

cd /d "%~dp0"

echo ======================================================
echo          web-team 项目一键部署脚本 v6.9
echo ======================================================

:: --- 1. 寻找 XAMPP ---
set "XAMPP_PATH="
for %%d in (C D E F G) do (
    if exist "%%d:\xampp\xampp-control.exe" (
        set "XAMPP_PATH=%%d:\xampp"
        goto :FOUND_XAMPP
    )
)

:NOT_FOUND
echo [错误] 未能找到 XAMPP 安装目录。
echo 建议：请确保你安装了 XAMPP，或者手动修改脚本中的 XAMPP_PATH。
pause & exit

:FOUND_XAMPP
set "PHP_EXE=%XAMPP_PATH%\php\php.exe"
set "MYSQL_EXE=%XAMPP_PATH%\mysql\bin\mysql.exe"

:: --- 2. 核心依赖处理 ---
if not exist "vendor" (
    echo [*] 正在下载依赖利用内置 composer.phar...    
    "%PHP_EXE%" composer.phar update --no-interaction --ignore-platform-reqs --no-audit --no-security-blocking
    if %errorlevel% neq 0 (
        echo [错误] 依赖下载中断。
        echo 建议：1. 检查网络连接；2. 尝试开启 VPN；3. 检查 PHP 版本是否冲突。
        pause & exit
    )
    echo [成功] 依赖库已就绪。
)

:: --- 3. 启动服务 ---
echo [*] 尝试启动 Apache 和 MySQL...
start /b "" "%XAMPP_PATH%\apache_start.bat" >nul 2>&1
start /b "" "%XAMPP_PATH%\mysql_start.bat" >nul 2>&1

:: 给数据库一点启动时间
echo [*] Loading environment, please wait...
timeout /t 8 /nobreak >nul

:: --- 4. 环境初始化 ---
if exist "init.bat" (
    echo [*] 正在执行 Yii2 初始化...
    echo yes | call init.bat --env=Development --overwrite=All >nul 2>&1
    if %errorlevel% neq 0 (
        echo [错误] init.bat 执行失败。
        echo 建议：请检查项目结构是否完整，或手动运行 init.bat 查看报错。
    )
)

:: --- 5. 数据库配置 ---
set DB_NAME=anti_war_db
echo [*] 正在配置数据库: %DB_NAME%

:: 检查 MySQL 能否连接
"%MYSQL_EXE%" -u root -e "CREATE DATABASE IF NOT EXISTS %DB_NAME% DEFAULT CHARACTER SET utf8mb4;" >nul 2>&1
if %errorlevel% neq 0 (
    echo [严重错误] 无法连接到 MySQL 数据库！
    echo --------------------------------------------------
    echo 排查建议：
    echo 1. 端口占用：请检查是否已有其他 MySQL 占用了 3306 端口。
    echo 2. 服务崩溃：查看 XAMPP 面板中 MySQL 是否为红色。
    echo 3. 权限问题：尝试以管理员身份运行此脚本。
    echo --------------------------------------------------
    pause & exit
)

if exist "data\install.sql" (
    echo [*] 正在导入 SQL 数据...
    "%MYSQL_EXE%" -u root %DB_NAME% < data\install.sql >nul 2>&1
    if %errorlevel% neq 0 (
        echo [错误] SQL 数据导入失败。请检查 data\install.sql 文件是否正确。
    ) else (
        echo [成功] 数据库配置完成。
    )
)

:: --- 6. 最终完成提示 ---
echo.
echo ======================================================
echo         DEPLOYS SUCCESS: 部署任务完成！
echo ======================================================
for %%I in ("%CD%") do set "PROJ_NAME=%%~nxI"
echo 前端访问: http://localhost/%PROJ_NAME%/frontend/web/
echo 后端管理: http://localhost/%PROJ_NAME%/backend/web/
echo.
echo 如果点击链接后报错，请检查 XAMPP 面板中 Apache/MySQL 状态。
echo ======================================================
pause