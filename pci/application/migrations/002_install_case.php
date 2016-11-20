<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Migration_Install_Case extends CI_Migration{
        public function up(){
            //creates case table
            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'title' => array(
                    'type' => 'TEXT',
                    'null' => FALSE
                ),
                'evidence' => array(
                    'type' => 'TEXT',
                    'null' => FALSE
                ),
                'subject' => array(
                    'type' => 'TEXT',
                    'null' => FALSE
                ),
                'reason' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'claim' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'grounds' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'precedence' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'incident_start' => array(
                    'type' => 'DATE',
                    'null' => 'TRUE'
                ),
				'incident_end' => array(
                    'type' => 'DATE',
                    'null' => 'TRUE'
                ),
                'status' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 25
                ),
				'moderation' => array(
					'type' => 'TEXT'
				),
                'author' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => TRUE,
                ),
				'author_prosecuting' => array(
                    'type' => 'TINYINT',
                    'constraint' => 1,
                    'unsigned' => TRUE,
                ),
                'creation' => array(
                    'type' => 'DATETIME'
                )
            ));
            $this->dbforge->add_key('id',TRUE);
            $this->dbforge->create_table('case');
            //creates defendant table
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
                'type' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 25
                )
            ));
            $this->dbforge->add_key('id',TRUE);
            $this->dbforge->create_table('defendant');
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
                'type' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 25
                )
            ));
            $this->dbforge->add_key('id',TRUE);
            $this->dbforge->create_table('prosecutor');
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
                'type' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 25
                )
            ));
            $this->dbforge->add_key('id',TRUE);
            $this->dbforge->create_table('judge');
        }
        public function down(){
            if($this->db->table_exists('case')){
                $this->dbforge->drop_table('case');
            }
            if($this->db->table_exists('defendant')){
                $this->dbforge->drop_table('defendant');
            }
            if($this->db->table_exists('prosecutor')){
                $this->dbforge->drop_table('prosecutor');
            }
            if($this->db->table_exists('judge')){
                $this->dbforge->drop_table('judge');
            }
        }
    }