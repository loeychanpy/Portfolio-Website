<?php

namespace App\Controllers;

use CodeIgniter\Database\Forge;

class Setup extends BaseController
{
    public function index()
    {
        if (file_exists(APPPATH . '../.setup-done')) {
            return view('setup_done');
        }
        return view('setup');
    }

    public function process()
    {
        try {
            $db = \Config\Database::connect();
            $forge = $db->forge();

            // Create users table
            if (!$this->tableExists('users', $db)) {
                $forge->addField([
                    'id' => [
                        'type' => 'INT',
                        'constraint' => 11,
                        'unsigned' => true,
                        'auto_increment' => true,
                    ],
                    'username' => [
                        'type' => 'VARCHAR',
                        'constraint' => 50,
                        'unique' => true,
                    ],
                    'password' => [
                        'type' => 'VARCHAR',
                        'constraint' => 255,
                    ],
                    'full_name' => [
                        'type' => 'VARCHAR',
                        'constraint' => 100,
                        'null' => true,
                    ],
                ]);
                $forge->addKey('id', false, true);
                $forge->createTable('users');
            }

            // Create articles table
            if (!$this->tableExists('articles', $db)) {
                $forge->addField([
                    'id' => [
                        'type' => 'INT',
                        'constraint' => 11,
                        'unsigned' => true,
                        'auto_increment' => true,
                    ],
                    'title' => [
                        'type' => 'VARCHAR',
                        'constraint' => 255,
                    ],
                    'content' => [
                        'type' => 'LONGTEXT',
                    ],
                    'created_at' => [
                        'type' => 'DATETIME',
                        'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
                    ],
                    'updated_at' => [
                        'type' => 'DATETIME',
                        'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
                        'on_update' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
                    ],
                ]);
                $forge->addKey('id', false, true);
                $forge->createTable('articles');
            }

            // Create gallery table
            if (!$this->tableExists('gallery', $db)) {
                $forge->addField([
                    'id' => [
                        'type' => 'INT',
                        'constraint' => 11,
                        'unsigned' => true,
                        'auto_increment' => true,
                    ],
                    'title' => [
                        'type' => 'VARCHAR',
                        'constraint' => 255,
                    ],
                    'description' => [
                        'type' => 'TEXT',
                        'null' => true,
                    ],
                    'image' => [
                        'type' => 'VARCHAR',
                        'constraint' => 255,
                    ],
                    'created_at' => [
                        'type' => 'DATETIME',
                        'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
                    ],
                    'updated_at' => [
                        'type' => 'DATETIME',
                        'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
                        'on_update' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
                    ],
                ]);
                $forge->addKey('id', false, true);
                $forge->createTable('gallery');
            }

            // Create messages table
            if (!$this->tableExists('messages', $db)) {
                $forge->addField([
                    'id' => [
                        'type' => 'INT',
                        'constraint' => 11,
                        'unsigned' => true,
                        'auto_increment' => true,
                    ],
                    'name' => [
                        'type' => 'VARCHAR',
                        'constraint' => 255,
                    ],
                    'email' => [
                        'type' => 'VARCHAR',
                        'constraint' => 255,
                    ],
                    'subject' => [
                        'type' => 'VARCHAR',
                        'constraint' => 255,
                    ],
                    'message' => [
                        'type' => 'LONGTEXT',
                    ],
                    'sent_at' => [
                        'type' => 'DATETIME',
                        'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
                    ],
                ]);
                $forge->addKey('id', false, true);
                $forge->createTable('messages');
            }

            // Insert default admin user
            $userModel = new \App\Models\UserModel();
            if ($userModel->countAll() === 0) {
                $userModel->insert([
                    'username' => 'admin',
                    'password' => password_hash('admin123', PASSWORD_DEFAULT),
                    'full_name' => 'Administrator',
                ]);
            }

            // Mark setup as done
            file_put_contents(APPPATH . '../.setup-done', 'Setup completed at ' . date('Y-m-d H:i:s'));

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Database setup completed successfully!',
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    private function tableExists(string $tableName, $db): bool
    {
        $tables = $db->listTables();
        return in_array($tableName, $tables);
    }
}
