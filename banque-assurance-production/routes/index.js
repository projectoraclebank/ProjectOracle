var express = require('express');
var router = express.Router();
var database=require("../config/database");
/* GET home page. */
var session;
router.get('/', function(req, res, next) {
  res.render('index');
});


router.get('/client',function(req,res,next){
  res.render('client',{message:"",userData:req.session.userData});
});

router.get('/logout',function(req,res){
  req.session.destroy();
  res.render('index');
});

router.post('/login',function(req,res){
  // console.log("SESSION:"+JSON.stringify(req.session));
  session=req.session;
  var pseudo=req.body.pseudo_client;
  var password=req.body.password;
  console.log('PSEUDO: '+pseudo+' PASSWORD: '+password);
  var sql="SELECT * FROM user_client WHERE pseudo_client=? AND password_client=?";
  database.query(sql,[pseudo,password],function(err,result){
    if(err){
      console.log("ERREUR :\n"+err);
    }
    else{
      if(result.length>0)
      {
        // var id_client=result.id_user_client;
        console.log('RESULT'+JSON.stringify(result));
        session.uniqueID=result[0].id_user_client;
        console.log("SESSION: "+JSON.stringify(session.uniqueID));
        session.userData=result[0];
        res.redirect('/client/dashboard_client');
      }
      else{
        res.render('client',{message:'Rentrer un compte valide',className:'alert alert-danger'})
      }
    }
  });

})

//** Route experimentatale pour tester les template
router.get('/forms',function(req,res){
  res.render('forms');
});

router.get('/index-template',function(req,res){
  res.render('index-template');
});

router.get('/login-template',function(req,res){
  res.render('login');
});

router.get('/register',function(req,res){
  res.render('register');
});

router.get('/tables',function(req,res){
  res.render('tables.ejs');
});

router.get('/client/dashboard_client',function(req,res,next){
  var userData="";
  if(session.uniqueID)
  {
    console.log("SESSION ID:"+session.uniqueID);
    console.log("IM INSIDE!: ");
    userData=session.userData;
  }
  res.render('dashboard_client',{userData:userData});
})

module.exports = router;
