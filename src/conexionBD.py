import json
import requests
from datetime import datetime as timeN
from datetime import date, time, timedelta
response = requests.get("http://192.168.0.12/enfasis3/datos.php")
todos = json.loads(response.text)


#nuevojson = open("/home/usuario/Escritorio/eljson.txt", "w")

for dat in todos["reglas"]:
	
	if str(dat["activacion"]) == "1":
		#nuevojson.write(str(dat["mac_src"])+" "+str(dat["mac_dst"])+" "+str(dat["hora_inicio"])+" "+str(dat["hora_fin"])+"\n");

		fuente = str(dat["mac_src"]);
		#00:00:00:00:00:00
		fuente = int(fuente[15:],16)		

		if(fuente<4):
			switch=3		
		elif(fuente<7):
			switch=4				
		elif(fuente<10):
			switch=5		
		elif(fuente<13):
			switch=7		
		elif(fuente<16):
			switch=8
		elif(fuente<19):
			switch=9
		elif(fuente<22):
			switch=11
		elif(fuente<25):
			switch=12	
		else:
			switch=13		

		if int(dat["temporal"]) == 1:
			"""
			horaIni = dat["hora_inicio"];
			horaIni = int(horaIni[0:2]);

			horaFin = dat["hora_fin"];
			horaFin = int(horaFin[0:2]);
			"""
			horaIni = time(int(dat["hora_inicio"][0:2]),int(dat["hora_inicio"][3:5]),0)			
			horaFin = time(int(dat["hora_fin"][0:2]),int(dat["hora_fin"][3:5]),0)			
			horaAct = time(timeN.now().hour,timeN.now().minute,0)			

			#if horaIni<=time.now().hour and horaFin>time.now().hour:
			if horaIni<=horaAct and horaFin>horaAct:
				
				headers = {"GET  HTTP/1.1 "
					"Content-Type": "application/json",
					"cache-control": "no-cache"
					}
				data = {'dpid':switch,
					'cookie':42,
					'priority':50000,
					'match':{
						'dl_dst':dat["mac_dst"],
						'dl_src':dat["mac_src"]
						},
					'actions':[]
					}

				data_json = json.dumps(data)
				url = "http://192.168.0.59:8080/stats/flowentry/add"
				
				response = requests.post(url, headers = headers, data = data_json)
				
				print("el switch es: "+str(switch)+"\nmac origen: "+dat["mac_src"]+
					"\nla hora Inicio es: "+dat["hora_inicio"]+
					"\nla hoa fin es: "+str(horaIni)+
					"\nla hora del sistema es : "+str(timeN.now().hour))
			else:
				
				headers = {"GET  HTTP/1.1 "
					"Content-Type": "application/json",
					"cache-control": "no-cache"
					}
				data = {'dpid':switch,
					'cookie':42,
					'priority':50000,
					'match':{
						'dl_dst':dat["mac_dst"],
						'dl_src':dat["mac_src"]
						},
					'actions':[]
					}

				data_json = json.dumps(data)
				url = "http://192.168.0.59:8080/stats/flowentry/delete_strict"
				
				response = requests.post(url, headers = headers, data = data_json)
							
				print("Regla eliminada")
				
		else:
			
			headers = {"GET  HTTP/1.1 "
					"Content-Type": "application/json",
					"cache-control": "no-cache"
					}
			data = {'dpid':switch,
				'cookie':42,
				'priority':50000,
				'match':{
					'dl_dst':dat["mac_dst"],
					'dl_src':dat["mac_src"]
					},
				'actions':[]
				}

			data_json = json.dumps(data)
			url = "http://192.168.0.59:8080/stats/flowentry/add"
			
			response = requests.post(url, headers = headers, data = data_json)
			
			print("Regla permanente agregada")	
	else:
		
		fuente = str(dat["mac_src"]);
		#00:00:00:00:00:00
		fuente = int(fuente[15:],16)
		
		

		if(fuente<4):
			switch=3		
		elif(fuente<7):
			switch=4				
		elif(fuente<10):
			switch=5		
		elif(fuente<13):
			switch=7		
		elif(fuente<16):
			switch=8
		elif(fuente<19):
			switch=9
		elif(fuente<22):
			switch=11
		elif(fuente<25):
			switch=12	
		else:
			switch=13



		headers = {"GET  HTTP/1.1 "
			"Content-Type": "application/json",
			"cache-control": "no-cache"
			}
		data = {'dpid':switch,
			'cookie':42,
			'priority':50000,
			'match':{
				'dl_dst':dat["mac_dst"],
				'dl_src':dat["mac_src"]
				},
			'actions':[]
			}

		data_json = json.dumps(data)
		url = "http://192.168.0.59:8080/stats/flowentry/delete_strict"
		
		response = requests.post(url, headers = headers, data = data_json)
		
		print("Regla eliminada")
			
#nuevojson.close();


