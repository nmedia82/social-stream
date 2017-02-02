<?php 
/**
 * Let's install Laravel with Screen
 * @version 1.0;
 * @by N-Media
 **/
 
 class NM_LV_Installer {
     
     public $project_dir_path, $php_ver, $env_file_path;
     
     function __construct() {
         
        $this -> project_dir_path = dirname(__FILE__). '/..';
        $this -> env_file_path = $this -> project_dir_path . '/.env';
    }
     

    public function check_requirements(){

        $data = array(

            'php_version' => array(
                'label' => 'PHP Version',
                'message' => '',
                'status' => (version_compare(phpversion(), '5.6.4', '<')) ? false : true,
            ),

            'pdo' => array(
                'label' => 'PDO',
                'message' => '',
                'status' => (!defined('PDO::ATTR_DRIVER_NAME')) ? false : true,
            ),

            'mbstring' => array(
                'label' => 'mbstring',
                'message' => '',
                'status' => (extension_loaded('mbstring')) ? true : false,
            ),

            'tokenizer' => array(
                'label' => 'tokenizer',
                'message' => '',
                'status' => (extension_loaded('tokenizer')) ? true : false,
            ),

            'openssl' => array(
                'label' => 'Openssl',
                'message' => '',
                'status' => (!defined('OPENSSL_VERSION_NUMBER')) ? false : true,
            ),

        );

        return $data;

    }

    public function check_permissions(){

        $data = array(

            'storage.app' => array(
                'label' => 'storage/app/',
                'message' => substr(sprintf('%o', fileperms($this -> project_dir_path.'/storage/app')), -3),
                'status' => (is_writable($this -> project_dir_path.'/storage/app')) ? true : false,
            ),

            'storage.framework' => array(
                'label' => 'storage/framework/',
                'message' => substr(sprintf('%o', fileperms($this -> project_dir_path.'/storage/framework')), -3),
                'status' => (is_writable($this -> project_dir_path.'/storage/framework')) ? true : false,
            ),

            'storage.logs' => array(
                'label' => 'storage/logs/',
                'message' => substr(sprintf('%o', fileperms($this -> project_dir_path.'/storage/logs')), -3),
                'status' => (is_writable($this -> project_dir_path.'/storage/logs')) ? true : false,
            ),

            'bootstrap.cache' => array(
                'label' => 'bootstrap/cache/',
                'message' => substr(sprintf('%o', fileperms($this -> project_dir_path.'/bootstrap/cache')), -3),
                'status' => (is_writable($this -> project_dir_path.'/bootstrap/cache')) ? true : false,
            ),

        );

        return $data;

    }    
     
     public function set_env_file($db_user, $db_name, $db_pass) {
         
         $env_vars = array( '_DB_USER_'     => $db_user,
                            '_DB_NAME_'     => $db_name,
                            '_DB_PASS_'     => $db_pass);
                            
        if( ! file_exists($this -> env_file_path) ){
            die('Enviroment File Not Found. ' . $this -> env_file_path);
        }
        
        //read the entire string
        $str = file_get_contents( $this -> env_file_path );
            
        // searching the db constanct and replacing
        foreach($env_vars as $search => $replace ){
            
            //replace something in the file string - this is a VERY simple example
            $str = str_replace("$search", "$replace", $str);
            
            //write the entire string
            file_put_contents($this -> env_file_path, $str);
        }
     }
     
     
    public function run_migrations() {
         
         $project_dir = $this -> project_dir_path;
         echo "php $project_dir/artisan migrate:refresh";
         echo exec("php $project_dir/artisan migrate:refresh");

    }
 }