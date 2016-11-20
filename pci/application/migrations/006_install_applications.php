<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Migration_Install_Applications extends CI_Migration{
        public function up(){
			$this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'content' => array(
                    'type' => 'TEXT',
                    'null' => FALSE
                ),
                'type' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 25
                ),
				'status' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 25
                ),
                'creation' => array(
                    'type' => 'DATETIME'
                )
            ));
            $this->dbforge->add_key('id',TRUE);
            $this->dbforge->create_table('application');
        }
        public function down(){
			if($this->db->table_exists('application')){
                $this->dbforge->drop_table('application');
            }
        }
    }