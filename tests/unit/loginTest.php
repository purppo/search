<?php
use AspectMock\Test as test;

class loginTest extends \Codeception\TestCase\Test
{
    use \Codeception\Specify;
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
        test::clean();
        $conf = Setting::getSetting('conf',''); //設定系データ取得
        $config = new Zend_Config($conf);
        $this->lib = new ConnectDB($config);
        //$this->smarty = new Smarty;Smartyを入れると大変なことになる
        $this->Auth = new Auth($this->lib,array());
    }

    protected function _after()
    {
    }

    // tests
    public function testLogin()
    {
        $this->specify("email is required", function() {
            $params['email'] = '';
            $params['password'] = 'qweqwe';
            $this->assertEquals(1 ,count(Common::chkLogin($params)));
        });
        
        $this->specify("password is required", function() {
            $params['email'] = 'sangjun@psinc.jp';
            $params['password'] = '';
            $this->assertEquals(1 ,count(Common::chkLogin($params)));
        });
        
        $this->specify("login checked", function() {
            $params['email'] = 'psinc@psinc.jp';
            $params['password'] = 'qweqwe';
            $res = $this->Auth->execLogin($params['email'],$params['password']);
            $this->assertTrue($res);
            
            //$this->assertEquals(TRUE, $auth->execLogin2($params['email'],$params['password']));
            
            //echo "#############################";
            //e($auth->execLogin2($params['email'],$params['password']));
            
            //$auth->verifyInvoked('execLogin2'); // => success
            
            
            
            //$res = $this->Auth->execLogin($params['email'],$params['password']);
            
            //$Auth = test::double(new Auth($this->lib,array()), ['execLogin' => true]);
            
            //test::double('Auth', ['execLogin' => FALSE]);
            //$Auth = new Auth($this->lib,array());
            //$this->assertEquals(FALSE, $Auth->execLogin($params['email'],$params['password']));
            
            
            //e($Auth->execLogin($params['email'],$params['password']));
            //exit;
            //$Auth->execLogin($params['email'],$params['password']);
            //$this->assertEquals(true, $Auth->execLogin($params['email'],$params['password']));
           // $Auth->verifyInvokedOnce('execLogin');
            //$this->assertFalse($res);
        });
        
    }
}