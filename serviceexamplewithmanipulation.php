<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService{
    public $user_repository;
    public function __construct(UserRepository $user_repository){
        $this->user_repository=$user_repository;
    }
    public function loadUsers(){
        $results = $this->user_repository->loadUsers();
        $datastorage=[];
        foreach($results as $result){
            $datastorage[] = [
                "id" => $result["id"],
                "employee_id" => $result["employee_id"],
                "role_access" => $result["role_access"],
                "section_id" => $result["section_data"]["id"],
                "section_name" => $result["section_data"]["section_name"],
            ];
        }

        return $datastorage;

    }
    public function storeUser($data){
        return $this->user_repository->storeUser($data);
    }
    public function showUser($id){
        return $this->user_repository->showUser($id);
    }
    public function updateUser($id, $data){
        return $this->user_repository->updateUser($id, $data);
    }
    public function deleteUser($id){
        return $this->user_repository->deleteUser($id);
    }

}
