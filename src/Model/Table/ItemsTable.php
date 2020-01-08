<?php

namespace App\Model\Table;
use Cake\ORM\Table;

class UsersTable extends Table
{
    public function initialize(array $config)
    {
        $this->setTable('users');
        $this->setDisplayField('username');
        $this->setPrimaryKey('id');

       

        $this->addBehavior('SellIT/Upload.Upload', [
            'photo' => [
                'fields' => [
                   
                    'dir' => 'photo_dir', 
 
                ],
            ],
        ]);
    }
}
?>
<?php