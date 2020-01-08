<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{
    //https://book.cakephp.org/3.next/en/tutorials-and-examples/blog-auth-example/auth.html
    public function validationDefault(Validator $validator)
    {
        return $validator
            ->notEmpty('email', 'A email is required')
            ->notEmpty('password', 'A password is required');
            
    }

}