<?php
?>
<script type="text/javascript" src="./bower_components/jquery/dist/jquery.min.js"></script>

<script type="text/javascript" src="./assets/js/config.js"></script>
<script type="text/javascript" src="./assets/js/function.js"></script>

<script type="text/javascript">

  var conf = {
    uid: 'dGFnb29uLnBAZ21haWwuY29tXzIwMTgwNzAy'
  }

  $(document).ready(function(){
    console.log('Document ready');
    var param = {
      uid: conf.uid
    }
    var jxr = $.post(configuration.ws_url + 'get_server_list.php', param, function(){}, 'json')
               .always(function(snap){
                 if(fnc.checksnap(snap)){
                    snap.forEach(function(i){
                      var jxr = $.post('http://' + i.s_ip + '/hserver_monitor/target_server/response.php', function(){})
                                 .always(function(resp){
                                   console.log(resp);
                                   if(resp == 'Y'){
                                     var param2 = {
                                       uid: conf.uid,
                                       ip: i.s_ip,
                                       response: '1'
                                     }
                                     var jxr2 = $.post(configuration.ws_url + 'set_server_reponse_log.php', param2, function(res){console.log(res);})
                                   }else{
                                     var param2 = {
                                       uid: conf.uid,
                                       ip: i.s_ip,
                                       response: '0'
                                     }
                                     var jxr2 = $.post(configuration.ws_url + 'set_server_reponse_log.php', param2, function(){console.log(res);})
                                   }
                                 })
                                 .fail(function(){
                                   var param2 = {
                                     uid: conf.uid,
                                     ip: i.s_ip,
                                     response: '0'
                                   }
                                   var jxr2 = $.post(configuration.ws_url + 'set_server_reponse_log.php', param, function(){console.log(res);})
                                 })
                    })
                 }
               })
  })
</script>
<?php
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>


  </body>
</html>
