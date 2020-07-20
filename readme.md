https://github.com/ITchookiat/Projectleasing.git

ติดตั้งตัว xammp
    - แก้ไขไฟล์ php.ini 
        1. post_max_size=8M ->     post_max_size=10G
        2. upload_max_filesize=2M ->     upload_max_filesize=10G
        3.max_file_uploads=20 ->    max_file_uploads=100
        4.เพิ่มคำไสั่ง extension=php_pdo_sqlsrv_72_ts.dll
        
    - เพิ่มไฟล์ php_pdo_sqlsrv_72_ts.dll ในโฟรเดอร์ Xammp/php/ext
    
    - ติดตั้งตัว SQL SERVER 2017-2018
        
