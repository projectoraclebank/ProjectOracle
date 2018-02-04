var express = require('express');
var router = express.Router();
var database=require("../config/database");
/* GET home page. */
var session;
router.get('/', function(req, res, next) {
   res.render('index');
});


router.get('/client',function(req,res,next){
  res.render('client',{message:""});
});

router.post('/login',function(req,res){
  // console.log("SESSION:"+JSON.stringify(req.session));
  session=req.session;
  var pseudo=req.body.pseudo_client;
  var password=req.body.password;
  var sql="SELECT * FROM user_client WHERE pseudo_client=? AND password_client=?";
  database.query(sql,[pseudo,password],function(err,result){
    if(err) throw err;
    if(result.length>0)
    {
      session.uniqueID=result.id_user_client;
      console.log("SESSION: "+JSON.stringify(session));
      session.userData=result;
      res.redirect('/client/dashboard_client');
    }
    else{
      res.render('client',{message:'Rentrer un compte valide',className:'alert alert-danger'})
    }
  });

})

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
