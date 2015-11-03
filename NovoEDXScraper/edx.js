var page = require('webpage').create();
var fs = require('fs');

system = require('system');
var site = system.args[1];

page.open('https://www.edx.org/course/' + site, function () {
    page.evaluate(function(){

    });
    console.log('https://www.edx.org/course/' + site);

    //page.render('edxImages/' + site + '.png');
    fs.write('edx/' + site + '.html', page.content, 'w');
    phantom.exit();
});