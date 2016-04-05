var page = require('webpage').create();
var system = require('system');
var url = system.args[1];
page.open(url, function(status) {
    if(status === "success") {
        console.log(page.content); //page source
    }
  phantom.exit();
});
