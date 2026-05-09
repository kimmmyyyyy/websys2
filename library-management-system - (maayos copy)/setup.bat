@echo off
setlocal enabledelayedexpansion
cd /d "%~dp0"

echo ================================
echo Library Management System Setup
echo ================================
echo.
echo Current directory: %cd%
echo.

echo Step 1: Installing Composer dependencies...
call composer install
if errorlevel 1 goto error

echo.
echo Step 2: Creating .env file...
if not exist .env (
    copy .env.example .env
    echo .env file created!
) else (
    echo .env file already exists, skipping...
)

echo.
echo Step 3: Generating application key...
call php artisan key:generate
if errorlevel 1 goto error

echo.
echo Step 4: Setting directory permissions...
echo Creating required directories...
if not exist "bootstrap\cache" mkdir "bootstrap\cache"
if not exist "storage" mkdir "storage"
if not exist "storage\logs" mkdir "storage\logs"
if not exist "storage\app" mkdir "storage\app"
if not exist "storage\framework\cache" mkdir "storage\framework\cache"
if not exist "storage\framework\sessions" mkdir "storage\framework\sessions"
if not exist "storage\framework\views" mkdir "storage\framework\views"

echo Setting write permissions (run as administrator if needed)...
icacls "bootstrap\cache" /grant:r "%USERNAME%":F /T >nul
icacls "storage" /grant:r "%USERNAME%":F /T >nul

echo.
echo ================================
echo Setup Complete!
echo ================================
echo.
echo Next steps:
echo 1. Edit .env file and configure your database credentials
echo 2. Run: php artisan migrate
echo 3. Run: php artisan serve
echo 4. Visit: http://localhost:8000
echo.
goto end

:error
echo.
echo ================================
echo ERROR: Setup failed!
echo ================================
pause
goto end

:end
pause
