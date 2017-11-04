var express = require('express');
var path = require('path');
var favicon = require('serve-favicon');
var logger = require('morgan');
var cookieParser = require('cookie-parser');
var bodyParser = require('body-parser');

var index = require('./routes/index');
var users = require('./routes/users');

var app = express();

var reload = require('reload');

var RateLimit = require('express-rate-limit');



var limiter = new RateLimit({
  //windowMs: 2*60*1000, // 15 minutes 
  windowMs: 3*60*1000, // 15 minutes 
  max: 10, // limit each IP to 100 requests per windowMs 
  delayMs: 0, // disable delaying - full speed until the max limit is reached 
  //message: "Hello2!"
});

app.use("/getPreGameJSON*", limiter);
app.use("/getCurrentGameJSON*", limiter);

reload(app);

// view engine setup
app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'pug');

// uncomment after placing your favicon in /public
//app.use(favicon(path.join(__dirname, 'public', 'favicon.ico')));
app.use(logger('dev'));
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }));
app.use(cookieParser());
app.use(express.static(path.join(__dirname, 'public')));

app.use('/', index);
app.use('/users', users);

//Need this for URLs to be case-insensitive
app.set('case sensitive routing', false);

//express-uncapitalize fixes case sensitivity for files but not query parameters
//Requests will be 301 directed to the appropriate file
app.use(require('express-uncapitalize')());

var getPreGameJSON = require("./src_srv/getPreGameJSON.js");
var getCurrentGameJSON = require("./src_srv/getCurrentGameJSON.js");
var getPatch= require("./src_srv/getPatch.js");
var getChampStats= require("./src_srv/getChampStats.js");
var checkForLiveGame = require("./src_srv/checkForLiveGame.js");
var enterGameAndRetrieve = require("./src_srv/enterGameAndRetrieve.js");
var enterMultipleGamesAndRetrieve = require("./src_srv/enterMultipleGamesAndRetrieve.js");

app.use('/getPreGameJSON*', getPreGameJSON.getPreGameJSON);
app.use('/getCurrentGameJSON*', getCurrentGameJSON.getCurrentGameJSON);
app.use('/getPatchShort', getPatch.getPatchShort);
app.use('/getPatchFull', getPatch.getPatchFull);
app.use('/checkGame', checkForLiveGame.checkGame);
app.use('/getChampStats*', getChampStats.getStats);
app.use('/enterGameAndRetrieve*', enterGameAndRetrieve.enter);
app.use('/enterMultipleGamesAndRetrieve*', enterMultipleGamesAndRetrieve.enter);



// catch 404 and forward to error handler
app.use(function(req, res, next) {
  var err = new Error('Not Found');
  err.status = 404;
  next(err);
});

// error handler
app.use(function(err, req, res, next) {
  // set locals, only providing error in development
  res.locals.message = err.message;
  res.locals.error = req.app.get('env') === 'development' ? err : {};

  // render the error page
  res.status(err.status || 500);
  res.render('error');
});


//app.use('/results.html*', limiter);

var NodeSpider = require('./src_srv/nodeSpider.js');

NodeSpider.start('na1', 10);

module.exports = app;
