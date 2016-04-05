var page = require('webpage').create();
page.settings.userAgent = ' Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.3';
page.settings.resourceTimeout = 2000; // 2 seconds
var system = require('system');
var url = system.args[1];
if(/naver/.test(url)){
    //naverはheaderを設定しないとだめ
    page.customHeaders = {
      "pragma": "no-cache",
      //"accept-encoding": "gzip, deflate, sdch",
      "accept-language": "ko-KR,ko;q=0.8,en-US;q=0.6,en;q=0.4",
      "upgrade-insecure-requests": "1",
      "accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",
      "cache-control": "no-cache",
      "authority": "search.naver.com",
    };
}
page.open(url, function(status) {
    if(status === "success") {
        console.log(page.content); //page source
    }
  phantom.exit();
});
