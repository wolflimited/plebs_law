<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Migration_Install_User_Details extends CI_Migration{
        public function up(){
  			$this->dbforge->add_column('users',array(
				'dob' => array(
					'type' => 'DATE'
				)
			));
			$this->dbforge->add_column('users',array(
				'tutorial' => array(
					'type' => 'TINYINT',
					'constraint' => 1,
                    'unsigned' => TRUE,
				)
			));
        }
        public function down(){
			$this->dbforge->drop_column('users','dob');
			$this->dbforge->drop_column('users','tutorial');
        }
    }