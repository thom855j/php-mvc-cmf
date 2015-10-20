var fs = require('fs'),
	args = require('system').args,
	page = require('webpage').create();

page.content = fs.read(args[1]);

page.viewportSize = {
	width: 1024,
	height: 1024
};

page.paperSize = {
	format: 'A2',
	orientation: 'portrait',
	margin: '1cm'
};

window.setTimeout(funtion (){
	page.render(args[1]);
	phantom.exit();
}, 1000);