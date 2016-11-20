<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Migration_Install_File_Manager extends CI_Migration{
        public function up(){
            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'attachment_id' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => TRUE,
                ),
                'name' => array(
                    'type' => 'TEXT',
                    'null' => TRUE,
                ), 
				'type' => array(
                    'type' => 'VARCHAR',
					'constraint' => 64,
                    'null' => TRUE,
				)
                'url' => array(
                    'type' => 'TEXT',
                    'null' => TRUE,
                ),
                'creation' => array(
                    'type' => 'DATETIME'
                )
            ));
            $this->dbforge->add_key('id',TRUE);
            $this->dbforge->create_table('file');
        }
        public function down(){
            if($this->db->table_exists('file')){
                $this->dbforge->drop_table('file');
            }
        }
    }