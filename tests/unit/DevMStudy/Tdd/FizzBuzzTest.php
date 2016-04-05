<?php
namespace DevMStudy\Tdd;
require_once __DIR__ . '/../../../../html/unit_test.php';

class FizzBuzzTest extends \Codeception\TestCase\Test
{
    protected $tester;

    protected $user_id;
    /**
     * @var \UnitTester
     */

    protected function _before()
    {
        // preparing a user, inserting user record to database
        $this->user_id = array('users'=>array(
            'username' => 'John',
            'email' => 'john@snow.com',
            'activation_key' => '123456',
            'is_active' => 0));
    }

    protected function _after()
    {
    }

    // tests
    public function testGenerateFizzBuzzSucceed()
    {
        
        //$I = $this->codeGuy;
        echo " I expect 1 is 1";
        $target = new FizzBuzz();
        $fizzBuzz = $target->generate(1, 30);

        //$I->expect("count(\$fizzBuzz) is 30");
        $this->assertCount(30, $fizzBuzz);

        //$I->expect("1 is 1");
        $this->assertEquals(1, $fizzBuzz[0]);
        
        $this->assertEquals($this->user_id['users']['activation_key'],'123456');
        
    }

    public function testAllMethodsTested()
    {
        $target_class = substr(__CLASS__, 0, -5);
        $class_methods = get_class_methods($target_class);
        $test_methods = get_class_methods(__CLASS__);
    
        $result = in_array('test_'.$class_method, $test_methods);
    
        //FAIL WITH A USEFUL ERROR
        $this->assertTrue($result, 'There is no test for '.$target_class.'::'.$class_method);
    }


}