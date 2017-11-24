<?php
namespace Test\App;
use App\DataAccess\User\UserDataAccess;
use Core\Interfaces\_AppTest;

/**
*
*/
class UserTest extends _AppTest
{

    public function testGetUser()
    {
        $user = UserDataAccess::getById(1);
        $this->assertEquals($user->id,1);
    }

    public function testSample() {
        $this->assertTrue(true);
    }
}
