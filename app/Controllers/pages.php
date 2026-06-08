<?php 
namespace App\Controllers;

use App\Models\GalleryModel;
use App\Models\ArticleModel;
use App\Models\MessageModel;

class pages extends BaseController
{
    public function home()
    {
        // Pass the active page name to the navigation view
        $data['page'] = 'home';
        $data['base_url'] = base_url();

        echo view('includes/html_head', $data);
        echo view('includes/nav', $data);
        echo view('pages/home', $data);
        echo view('includes/footer', $data);
    }

    public function about()
    {
        $data['page'] = 'about';
        $data['base_url'] = base_url();

        echo view('includes/html_head', $data);
        echo view('includes/nav', $data);
        echo view('pages/about', $data);
        echo view('includes/footer', $data);
    }

    public function projects()
    {
        $data['page'] = 'projects';
        $data['base_url'] = base_url();

        echo view('includes/html_head', $data);
        echo view('includes/nav', $data);
        echo view('pages/projects', $data);
        echo view('includes/footer', $data);
    }


    public function contact()
    {
        $data['page'] = 'contact';
        $data['base_url'] = base_url();

        echo view('includes/html_head', $data);
        echo view('includes/nav', $data);
        echo view('pages/contact', $data);
        echo view('includes/footer', $data);
    }
    public function credit()
    {
        $data['page'] = 'credit';
        $data['base_url'] = base_url();

        echo view('includes/html_head', $data);
        echo view('includes/nav', $data);
        echo view('pages/credit', $data);
        echo view('includes/footer', $data);
    }

        public function news()
    {

        try {
            $articleModel = new ArticleModel();
            $data['articles'] = $articleModel->orderBy('created_at', 'DESC')->findAll();
        } 
        catch (\Exception $e) 
        {
            $data['articles'] = [];
        }
            
        $data['page'] = 'news';
        $data['base_url'] = base_url();

        echo view('includes/html_head', $data);
        echo view('includes/nav', $data);
        echo view('pages/news', $data);
        echo view('includes/footer', $data);
    }

    public function article_detail($id = null)
    {
        if (!$id) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Article ID not provided");
        }
        $articleModel = new ArticleModel();
        $article = $articleModel->find($id);
        
        if (!$article) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Article Not Found");
        }
        
        $data['article'] = $article;
        $data['page'] = 'news';
        $data['base_url'] = base_url();

        echo view('includes/html_head', $data);
        echo view('includes/nav', $data);
        echo view('pages/article_detail', $data);
        echo view('includes/footer', $data);
    }

    public function gallery()
    {
        try {
            $galleryModel = new GalleryModel();
            $data['gallery']= $galleryModel->orderBy('created_at', 'DESC')->findAll();
        } catch (\Exception $e) {
            $data['gallery'] = [];
        }
        $data['page'] = 'gallery';
        $data['base_url'] = base_url();

        echo view('includes/html_head', $data);
        echo view('includes/nav', $data);
        echo view('pages/gallery', $data);
        echo view('includes/footer', $data);
    }

    public function sendContact()
    {
        $json = $this->request->getJSON(true) ?? [];

        $rules = [
            'name'    => 'required|min_length[2]|max_length[255]',
            'email'   => 'required|valid_email|max_length[255]',
            'message' => 'required|min_length[5]',
        ];

        $validation = \Config\Services::validation();
        if (!$validation->setRules($rules)->run($json)) {
            return $this->response
                ->setJSON(['status' => 'error', 'message' => implode(' ', $validation->getErrors())])
                ->setStatusCode(422);
        }

        $messageModel = new MessageModel();
        $messageModel->insert([
            'name'    => $json['name'],
            'email'   => $json['email'],
            'subject' => $json['subject'] ?? 'Contact Form Message',
            'message' => $json['message'],
        ]);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Thank you! Your message has been sent successfully.',
        ]);
    }

}