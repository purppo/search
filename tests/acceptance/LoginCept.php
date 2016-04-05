<?php 
$I = new AcceptanceTester($scenario);
//$I->wantTo('perform actions and see result');
$I->amOnUrl('http://bhpc-sys.com');//page移動
$I->see('ログイン','strong');//画面チェック
$I->fillField('email', 'sangjun@psinc.jp');//ID設定
$I->fillField('password', 'qweqwe');//PW設定
$I->click('　ログイン　');//クリックイベント発生
$I->dontSee('　ログイン　');//画面チェック
$I->click('こちら');//クリックイベント発生
$I->dontSee('こちら');//画面チェック
$I->see('sangjun');//画面チェック
?>