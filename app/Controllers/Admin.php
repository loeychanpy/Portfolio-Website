<?php

namespace App\Controllers;

use App\Models\ArticleModel;
use App\Models\GalleryModel;
use App\Models\MessageModel;
use App\Models\UserModel;

class Admin extends BaseController
{
    protected ArticleModel $articleModel;
    protected GalleryModel $galleryModel;
    protected MessageModel $messageModel;
    protected UserModel    $userModel;

    public function __construct()
    {
        helper(['url', 'form']);
        $this->articleModel = new ArticleModel();
        $this->galleryModel = new GalleryModel();
        $this->messageModel = new MessageModel();
        $this->userModel    = new UserModel();
    }

    // ---------------------------------------------------------------
    // Render helper: wraps a content view with the admin layout
    // ---------------------------------------------------------------
    protected function render(string $view, array $data = [])
    {
        $data += [
            'current_page' => '',
            'admin_name'   => session()->get('admin_name') ?? 'Admin',
        ];

        $out  = view('administrator/includes/header', $data);
        $out .= view('administrator/includes/alerts');
        $out .= view($view, $data);
        $out .= view('administrator/includes/footer');

        return $this->response->setBody($out);
    }

    // ---------------------------------------------------------------
    // Root redirect
    // ---------------------------------------------------------------
    public function index()
    {
        return redirect()->to(base_url('administrator/dashboard'));
    }

    // ---------------------------------------------------------------
    // AUTH
    // ---------------------------------------------------------------
    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to(base_url('administrator/dashboard'));
        }

        $data = ['error' => session()->getFlashdata('login_error') ?? ''];

        if ($this->request->is('post')) {
            if (!$this->validate(['username' => 'required', 'password' => 'required'])) {
                $data['error'] = 'Please fill in all fields.';
                return view('administrator/login', $data);
            }

            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $user     = $this->userModel->findByUsername($username);

            if (!$user) {
                $data['error'] = 'Username not found.';
                return view('administrator/login', $data);
            }

            if (!password_verify($password, $user['password'])) {
                $data['error'] = 'Incorrect password.';
                return view('administrator/login', $data);
            }

            // Success
            session()->set([
                'isLoggedIn' => true,
                'admin_id'   => $user['id'],
                'admin_name' => $user['full_name'] ?? $user['username'],
            ]);
            return redirect()->to(base_url('administrator/dashboard'));
        }

        return view('administrator/login', $data);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('administrator/login'));
    }

    public function register()
    {
        $data = ['error' => '', 'success' => ''];

        if ($this->request->is('post')) {
            $rules = [
                'full_name' => 'required|min_length[2]|max_length[100]',
                'username'  => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
                'password'  => 'required|min_length[6]',
            ];
            $messages = [
                'username' => [
                    'is_unique' => 'Username already exists. Please choose a different one.',
                ],
            ];

            if (!$this->validate($rules, $messages)) {
                $data['error'] = implode(' ', $this->validator->getErrors());
            } else {
                $this->userModel->insert([
                    'username'  => $this->request->getPost('username'),
                    'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                    'full_name' => $this->request->getPost('full_name'),
                ]);
                $data['success'] = 'Account created! You can now log in.';
            }
        }

        return view('administrator/register', $data);
    }

    // ---------------------------------------------------------------
    // DASHBOARD
    // ---------------------------------------------------------------
    public function dashboard()
    {
        return $this->render('administrator/dashboard', [
            'current_page'    => 'dashboard',
            'article_count'   => $this->articleModel->countAllResults(),
            'gallery_count'   => $this->galleryModel->countAllResults(),
            'message_count'   => $this->messageModel->countAllResults(),
            'recent_messages' => $this->messageModel->orderBy('sent_at', 'DESC')->limit(5)->findAll(),
        ]);
    }

    // ---------------------------------------------------------------
    // ARTICLES
    // ---------------------------------------------------------------
    public function articles()
    {
        return $this->render('administrator/articles', [
            'current_page' => 'articles',
            'articles'     => $this->articleModel->orderBy('created_at', 'DESC')->findAll(),
        ]);
    }

    public function articleForm(int $id = 0)
    {
        $article = $id > 0 ? $this->articleModel->find($id) : null;

        if ($id > 0 && !$article) {
            return redirect()->to(base_url('administrator/articles'));
        }

        return $this->render('administrator/article_form', [
            'current_page' => 'articles',
            'article'      => $article,
            'is_edit'      => $id > 0,
            'errors'       => session()->getFlashdata('errors') ?? [],
            'old_input'    => session()->getFlashdata('old_input') ?? [],
        ]);
    }

    public function articleSave()
    {
        $id    = (int) $this->request->getPost('id');
        $rules = [
            'title'   => 'required|min_length[3]|max_length[255]',
            'content' => 'required|min_length[10]',
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('errors', $this->validator->getErrors());
            session()->setFlashdata('old_input', $this->request->getPost());
            return redirect()->to(base_url($id > 0 ? "administrator/articles/edit/{$id}" : 'administrator/articles/new'));
        }

        $payload = [
            'title'   => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
        ];

        if ($id > 0) {
            $this->articleModel->update($id, $payload);
            session()->setFlashdata('success', 'Article updated successfully.');
        } else {
            $this->articleModel->insert($payload);
            session()->setFlashdata('success', 'Article published successfully.');
        }

        return redirect()->to(base_url('administrator/articles'));
    }

    public function articleDelete(int $id)
    {
        $this->articleModel->delete($id);
        session()->setFlashdata('success', 'Article deleted.');
        return redirect()->to(base_url('administrator/articles'));
    }

    public function exportXml()
    {
        $articles = $this->articleModel->orderBy('created_at', 'DESC')->findAll();
        $xml      = new \SimpleXMLElement('<articles/>');

        foreach ($articles as $row) {
            $node = $xml->addChild('article');
            $node->addChild('id',      $row['id']);
            $node->addChild('title',   $row['title']);
            $node->addChild('content', $row['content']);
            $node->addChild('date',    $row['created_at']);
        }

        return $this->response
            ->setHeader('Content-Type', 'text/xml')
            ->setHeader('Content-Disposition', 'attachment; filename="articles_export.xml"')
            ->setBody($xml->asXML());
    }

    // ---------------------------------------------------------------
    // GALLERY
    // ---------------------------------------------------------------
    public function gallery()
    {
        return $this->render('administrator/gallery', [
            'current_page' => 'gallery',
            'photos'       => $this->galleryModel->orderBy('created_at', 'DESC')->findAll(),
        ]);
    }

    public function galleryForm(int $id = 0)
    {
        $photo = $id > 0 ? $this->galleryModel->find($id) : null;

        if ($id > 0 && !$photo) {
            return redirect()->to(base_url('administrator/gallery'));
        }

        return $this->render('administrator/gallery_form', [
            'current_page' => 'gallery',
            'photo'        => $photo,
            'is_edit'      => $id > 0,
            'errors'       => session()->getFlashdata('errors') ?? [],
            'old_input'    => session()->getFlashdata('old_input') ?? [],
        ]);
    }

    public function gallerySave()
    {
        $id         = (int) $this->request->getPost('id');
        $file       = $this->request->getFile('image_file');
        $hasNewFile = $file && $file->isValid() && !$file->hasMoved();

        
        $rules = ['title' => 'required|min_length[2]|max_length[255]'];
        if (!$id) {
            $rules['image_file'] = 'uploaded[image_file]|max_size[image_file,2048]|is_image[image_file]'
                . '|mime_in[image_file,image/jpg,image/jpeg,image/png,image/webp,image/gif]';
        } elseif ($hasNewFile) {
            $rules['image_file'] = 'max_size[image_file,2048]|is_image[image_file]'
                . '|mime_in[image_file,image/jpg,image/jpeg,image/png,image/webp,image/gif]';
        }

        if (!$this->validate($rules)) {
            session()->setFlashdata('errors', $this->validator->getErrors());
            session()->setFlashdata('old_input', $this->request->getPost());
            return redirect()->to(base_url($id > 0 ? "administrator/gallery/edit/{$id}" : 'administrator/gallery/new'));
        }

        $imageFilename = $this->request->getPost('existing_image') ?? '';

        if ($hasNewFile) {
            if ($id && !empty($imageFilename)) {
                $oldPath = FCPATH . 'assets/images/' . $imageFilename;
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            $imageFilename = $file->getRandomName();
            $file->move(FCPATH . 'assets/images', $imageFilename);
        }

        $payload = [
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description') ?? '',
            'image'       => $imageFilename,
        ];

        if ($id > 0) {
            $this->galleryModel->update($id, $payload);
            session()->setFlashdata('success', 'Photo updated successfully.');
        } else {
            $this->galleryModel->insert($payload);
            session()->setFlashdata('success', 'Photo uploaded successfully.');
        }

        return redirect()->to(base_url('administrator/gallery'));
    }

    public function galleryDelete(int $id)
    {
        $photo = $this->galleryModel->find($id);
        if ($photo) {
            $path = FCPATH . 'assets/images/' . $photo['image'];
            if (file_exists($path)) {
                unlink($path);
            }
            $this->galleryModel->delete($id);
        }
        session()->setFlashdata('success', 'Photo deleted.');
        return redirect()->to(base_url('administrator/gallery'));
    }

    // ---------------------------------------------------------------
    // MESSAGES
    // ---------------------------------------------------------------
    public function messages()
    {
        return $this->render('administrator/messages', [
            'current_page'  => 'messages',
            'messages_list' => $this->messageModel->orderBy('sent_at', 'DESC')->findAll(),
        ]);
    }

    public function message(int $id)
    {
        $msg = $this->messageModel->find($id);

        if (!$msg) {
            return redirect()->to(base_url('administrator/messages'));
        }

        return $this->render('administrator/message_detail', [
            'current_page' => 'messages',
            'msg'          => $msg,
        ]);
    }
}
