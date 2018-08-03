var Request = require("request");

var url = "http://simanh.psu.ac.th/hserver_monitor/controller/get_server_list.php?uid=dGFnb29uLnBAZ21haWwuY29tXzIwMTgwNzAy"
Request.get(url, (error, response, body) => {
    if(error) {
				return ;
    }
		if((JSON.parse(body) != '') && (JSON.parse(body).length > 0)){
			JSON.parse(body).forEach(function(i){
				// var url2 = 'http://' + i.s_ip + '/hserver_monitor/target_server/response.php';
				var url2 = i.s_ip + '/hserver_monitor/target_server/response.php';
				Request.get(url2, (error2, response2, body2) => {
					if(error){
						var url3 = 'http://simanh.psu.ac.th/hserver_monitor/controller/set_server_reponse_log.php?uid=dGFnb29uLnBAZ21haWwuY29tXzIwMTgwNzAy&ip=' + i.s_ip + '&response=0'
						Request.get(url3, (error3, response3, body3) => {})

						var url4 = 'http://simanh.psu.ac.th/hserver_monitor/controller/line_notify_msg.php?ip=' + i.s_ip
						Request.get(url4, (error4, response4, body4) => {
							// console.log(body4);
						})

					}else{
						// console.log(body2);
						// console.log(url2);
						var url3 = 'http://simanh.psu.ac.th/hserver_monitor/controller/set_server_reponse_log.php?uid=dGFnb29uLnBAZ21haWwuY29tXzIwMTgwNzAy&ip=' + i.s_ip + '&response=0'
						if(body2 == 'Y'){
							url3 = 'http://simanh.psu.ac.th/hserver_monitor/controller/set_server_reponse_log.php?uid=dGFnb29uLnBAZ21haWwuY29tXzIwMTgwNzAy&ip=' + i.s_ip + '&response=1'
						}else{
							var url4 = 'http://simanh.psu.ac.th/hserver_monitor/controller/line_notify_msg.php?ip=' + i.s_ip
							Request.get(url4, (error4, response4, body4) => {
								// console.log(body4);
							})
						}
						Request.get(url3, (error3, response3, body3) => {})
					}
				})
			})
		}
});
