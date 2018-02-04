
var mysql=require('mysql');
var connection=mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database:"project_oracle_db"
});
module.exports=connection;

// connection.connect(function(err) {
//     if(!err)
//     {
//       console.log("connected");
//       var sql="SELECT * FROM user_client";
//       connection.query(sql, function (err, result) {
//        if (err) throw err;
//        exports.getListeClient=result;
//      });
//     }
//
//   });

  // exports.clientIsInDatabase=function(email="",password=""){
  //   if(email!=="" || password=="")
  //   {
  //     var sql="SELECT * FROM user_client";
  //     connection.connect(function(err){
  //       connection.query(sql,function(err,result){
  //         if(err) throw err;
  //
  //       })
  //     });
  //   }
  // }


//module.exports=con;
