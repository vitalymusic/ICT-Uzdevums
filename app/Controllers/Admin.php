<?php

namespace App\Controllers;

class Admin extends BaseController
{
    function __construct()
    {
        $this->db = \Config\Database::connect();
        
        
    }

    public function index()
    {
        return view('admin/home');
    }

    public function categories()
    {
        $builder = $this->db->table('categories');
        $query= $builder->get();
        

        $data = [
            "category_table"=>$query->getResultArray()
        ];

        return view('admin/categories',$data);
    }

    public function categoryList(){
        $builder = $this->db->table('categories');
        $query= $builder->get();
        

        $data = $query->getResultArray();
        return $this->response->setJSON($data);

    }
    public function getCategoryById($id){
        $builder = $this->db->table('categories');
        $query= $builder->where("id",$id)->get();
        $data =  $query->getResultArray();
        return $this->response->setJSON($data);
    }
    public function saveCategory(){
        $builder = $this->db->table('categories');
        $data = [
            "cat_name"=>$this->request->getPost('category_name'),
            "cat_seo_name"=>$this->request->getPost('cat_seo_name'),
            "content"=>$this->request->getPost('content')
        ];
        if($builder->insert($data)){
            return "success";
        }

    }
    public function updateCategory($id){
        $builder = $this->db->table('categories');
        $data = [
            "cat_name"=>$this->request->getPost('category_name'),
            "cat_seo_name"=>$this->request->getPost('cat_seo_name'),
            "content"=>$this->request->getPost('content'),
            // "id"=>$this->request->getPost('cat_id')

        ];
        $builder->where('id',$id); 

        if($builder->update($data)){
            return "success";
        }      


    }
    public function deleteCategory($id){
        $builder = $this->db->table('categories');
        $builder->where('id', $id);
        if($builder->delete()){
            return "success";
        }
        

    }

    

    public function news()
    {
        $builder = $this->db->table('news');
        $builder->join('categories', 'categories.id = news.category_id', 'left');

        $query= $builder->get();
        $data = [
            "news_table"=>$query->getResultArray()
        ];

        return view('admin/news',$data);
    }
    public function getNewsById($id){
        $builder = $this->db->table('news');
        $query= $builder->where("news_id",$id)->get();
        $data =  $query->getResultArray();
        return $this->response->setJSON($data);
    }
    public function saveNews(){
        $builder = $this->db->table('news');
        $data = [
            "news_name"=>$this->request->getPost('news_name'),
            "category_id"=>$this->request->getPost('news_category_id'),
            "news_content"=>$this->request->getPost('news_content')
        ];
        if($builder->insert($data)){
            return "success";
        }

    }
    public function updateNews($id){
        $builder = $this->db->table('news');
        $data = [
            "news_name"=>$this->request->getPost('news_name'),
            "category_id"=>$this->request->getPost('news_category_id'),
            "news_content"=>$this->request->getPost('news_content')
        ];
        $builder->where('news_id',$id); 

        if($builder->update($data)){
            return "success";
        }      


    }
    public function deleteNews($id){
        $builder = $this->db->table('news');
        $builder->where('news_id', $id);
        if($builder->delete()){
            return "success";
        }
        

    }




    
    public function comments()
    {
        $builder = $this->db->table('comments');
        $query= $builder->get();
        $data = [
            "title"=>"Komentāri",
            "comments"=>$query->getResultArray()
        ];
        return view('admin/comments',$data);
    }
    public function deleteComments($id){
        $builder = $this->db->table('comments');
        $builder->where('comments_id', $id);
        if($builder->delete()){
            return "success";
        }
    }




    public function users()
    {
        $builder = $this->db->table('users');
        $query= $builder->get();
        $data = [
            "title"=>"Lietotāji",
            "users"=>$query->getResultArray()
        ];

        return view('admin/users',$data);
    }
    public function getUserById($id){
        $builder = $this->db->table('users');
        $query= $builder->where("users_id",$id)->get();
        $data =  $query->getResultArray();
        return $this->response->setJSON($data);
    }
    public function saveUser(){
        $builder = $this->db->table('users');
        $data = [
            "users_name"=>$this->request->getPost('users_name'),
            "users_surname"=>$this->request->getPost('users_surname'),
            "username"=>$this->request->getPost('username'),
            "password"=>md5($this->request->getPost('password')),
            "email"=>$this->request->getPost('email')
        ];
        if($builder->insert($data)){
            return "success";
        }

    }
    public function updateUser($id){
        $builder = $this->db->table('users');
        $data = [
            "users_name"=>$this->request->getPost('users_name'),
            "users_surname"=>$this->request->getPost('users_surname'),
            "username"=>$this->request->getPost('username'),
            "password"=>md5($this->request->getPost('password')),
            "email"=>$this->request->getPost('email')
        ];
        $builder->where('users_id',$id); 

        if($builder->update($data)){
            return "success";
        }      


    }
    public function deleteUser($id){
        $builder = $this->db->table('users');
        $builder->where('users_id', $id);
        if($builder->delete()){
            return "success";
        }
        

    }

    
}


// categories,admin/news,admin/comments,