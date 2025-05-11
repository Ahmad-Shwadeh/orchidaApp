@echo off
:: إعداد التاريخ والوقت للاسم
set TIMESTAMP=%DATE:~10,4%-%DATE:~4,2%-%DATE:~7,2%_%TIME:~0,2%-%TIME:~3,2%
set TIMESTAMP=%TIMESTAMP: =0%

:: إعدادات قاعدة البيانات
set DB_NAME=orchida_dashborad
set DB_USER=orchida_user
set DB_PASS=orchida2025
set DB_HOST=172.16.2.19

:: مجلد النسخ الاحتياطي داخل مشروعك
set BACKUP_PATH=D:\xampp\htdocs\orchidaApp\db_backups

:: أمر النسخ الاحتياطي
"D:\xampp\mysql\bin\mysqldump.exe" -h %DB_HOST% -P 3306 -u %DB_USER% -p%DB_PASS% %DB_NAME% > "%BACKUP_PATH%\%DB_NAME%_%TIMESTAMP%.sql"
