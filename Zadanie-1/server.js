var express = require('express');
var session = require('express-session');
var serverStatic = require('serve-static');
var app = express();

app.use(serverStatic(__dirname + '/public'));

app.use(session({
	secret: 'Losowo wygenerowany secret',
	resave: true,
	saveUninitialized: true,
	cookie: {
		httpOnly: false,
		secure: false
	}
}));

app.listen(3000, function() {
	console.log('Serwer rozpoczyna nasluchiwanie na localhost:3000');
});
