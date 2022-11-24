<?php

namespace App\Controllers;

class Front extends BaseController
{
    function __construct()
    {
        $this->db = \Config\Database::connect();  
    }
    public function index($category = NULL)
    {
        $builder = $this->db->table('news');
        $builder->join('categories', 'categories.id = news.category_id', 'left');
        $query= $builder->get();
        $data = [
            "title"=>"Ziņas",
            "news"=>$query->getResultArray()
        ];
        return view('front/home',$data);
        
    }
    public function getFilterData(){
        $builder = $this->db->table('categories');
        $query= $builder->get();
        $data = $query->getResultArray();
        return $this->response->setJSON($data);
    }

}
