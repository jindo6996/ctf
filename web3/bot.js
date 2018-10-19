var system = require('system');
var page = require('webpage').create();
var args = system.args;

if (args.length < 2) {
  console.log('Usage: phantomjs bot.js URL');
  phantom.exit()
} else {
  url = args[1];
}

phantom.addCookie({
	'name': 'flag',
	'value': 'matesctf{XSS_4nd_SQLi_Phant0mJS}',
	'domain'  : '127.0.0.1',
})

page.open(url, function() {
    setTimeout(function() {
        phantom.exit();
    }, 20);
});
