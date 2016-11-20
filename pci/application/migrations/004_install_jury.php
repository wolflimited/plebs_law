<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Migration_Install_Jury extends CI_Migration{
        public function up(){
            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'user_id' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => TRUE,
                ),
                'serving' => array(
                    'type' => 'BOOLEAN'
                )
            ));
            $this->dbforge->add_key('id',TRUE);
            $this->dbforge->create_table('jury_pool');
            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'case_id' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => TRUE,
                ),
                'user_id' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => TRUE,
                ),
				'status' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 25
                ),
				'reason' => array(
					'type' => 'TEXT'
				)
            ));
            $this->dbforge->add_key('id',TRUE);
            $this->dbforge->create_table('jury_service');
        }
        public function down(){
            if($this->db->table_exists('jury_pool')){
                $this->dbforge->drop_table('jury_pool');
            }
            if($this->db->table_exists('jury_service')){
                $this->dbforge->drop_table('jury_service');
            }
        }
    }