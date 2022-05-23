<?php

class CreateDb
{
    protected $_ci;
    private $hostDb;
    private $userDb;
    private $passDb;

    public function __construct()
    {
        $this->_ci = &get_instance();
        $this->_ci->load->database();
        $this->_ci->load->dbforge();
        
        // set up connection
        $this->hostDb = 'localhost';
        $this->userDb = 'root';
        $this->passDb = '';
    }
    
    /**
     * execute create database default
     *
     * @param  string $dbName
     *
     * @return array
     */
    public function exec($dbName)
    {
        // set new database name
        $dbName = isset($dbName) ? $dbName : "db_".time();

        // create database
        $sqlDb = $this->_ci->dbforge->create_database("$dbName");
        
        // check if success create db
        if ($sqlDb) {
            $this->dynamicDB = array(
                'hostname' => $this->hostDb ,
                'username' => $this->userDb,
                'password' => $this->passDb,
                'database' => $dbName,
                'dbdriver' => 'mysqli',
                'dbprefix' => '',
                'pconnect' => false,
                'db_debug' => (ENVIRONMENT !== 'production')
            );

            $dynamicDB = $this->_ci->load->database($this->dynamicDB, true);

            // create default table with transaction database for error handling
            $dynamicDB->trans_begin();
            
            $dynamicDB->query("CREATE TABLE `tb_settings`(
                `key` VARCHAR(30) NOT NULL,
                `value` TEXT NOT NULL,
                `desc` TEXT DEFAULT NULL,
                `created_at` INT NOT NULL DEFAULT 0,
                `modified_at` INT NOT NULL DEFAULT 0,
                `is_deleted` BOOLEAN NOT NULL DEFAULT 0,
                PRIMARY KEY (`key`)
                ) ENGINE=INNODB CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
            ");

            $dynamicDB->query("INSERT INTO tb_settings (`key`, `value`, `created_at`) VALUES
                ('mailer_alias', 'Ngodingin Indonesia', UNIX_TIMESTAMP(NOW())),
                ('mailer_host', 'smtp.gmail.com', UNIX_TIMESTAMP(NOW())),
                ('mailer_mode', '0', UNIX_TIMESTAMP(NOW())),
                ('mailer_password', '1234', UNIX_TIMESTAMP(NOW())),
                ('mailer_port', '587', UNIX_TIMESTAMP(NOW())),
                ('mailer_username', 'ngodingin.indonesia@gmail.com', UNIX_TIMESTAMP(NOW())),
                ('web_title', $dbName, UNIX_TIMESTAMP(NOW())),
                ('web_desc', 'Base Project', UNIX_TIMESTAMP(NOW())),
                ('web_icon', 'favicon.ico', UNIX_TIMESTAMP(NOW())),
                ('web_logo', 'favicon.ico', UNIX_TIMESTAMP(NOW()))
            ");

            $dynamicDB->trans_complete();

            if ($dynamicDB->trans_status() === false) {
                $dynamicDB->trans_rollback();
                return [
                    'status' => false,
                    'data' => $dynamicDB->error()

                ];
            } else {
                $dynamicDB->trans_commit();
                return [
                    'status' => true,
                    'data' => 'Berhasil'
                ];
            }
        } else {
            return [
                'status' => false,
                'data' => 'Gagal'
            ];
        }
    }
}
