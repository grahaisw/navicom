<?php

        include("config.php");
        
        $errors = true;
		/*
		 * Trying to connect to mysql server.
		 * Output Temporary error if unable to.
		 */
		if (!@mysql_connect($sql_host,$sql_user,$sql_pass)) {
			$results = Array(
				'head' => Array(
					'status' 		=> '0',
					'error_number'	=> '500', 
					'error_message' => 'Temporary Error.'.
					'Cannot connect to database, please try again later.'
				),
				'body' => Array ()
			);
			$errors = false;
		}

		/*
		 * Trying to enter the database.
		 * Output Temporary error if unable to.
		 */
		if (!@mysql_select_db($sql_name)) {
			$results = Array(
				'head' => Array(
					'status' 		=> '0',
					'error_number'	=> '500', 
					'error_message' => 'Temporary Error.'.
					'Database not found, please try again later.'
				),
				'body' => Array ()
			);
			$errors = false;
		}
		/*
		 * If no errors were found during connection
		 * let's proceed with out queries
		 * Token : f2a6b5e2a4e1aed9e759b09f4ce5c564
		 * plain : md5(navicomiptv)
		 */
		if($errors) {
		
		/*BEGIN INSERT BY TONJAW FEB 3, 2015*/
		$pms_method	= $_GET['method'];
		$pms_event	= $_GET['cmd'];
		$pms_date 	= $_GET['d'];
		$pms_time	= $_GET['t'];
		$pms_field	= urlencode($_GET['f']);
		$pms_token	= $_GET['token'];
		$gen4_url	= "http://172.10.20.8/navicom/pms/nis.php?method=$pms_method";
		
		switch ( $pms_event )
		{
		    case 'CEKIN':
			$gen4_url .= "&cmd=$pms_event&d=$pms_date&t=$pms_time&f=$pms_field&token=$pms_token&format=xml"; 
			$crot = @file_get_contents($gen4_url);
			break;
			
		    case 'CEKOUT':
			$gen4_url .= "&cmd=$pms_event&d=$pms_date&t=$pms_time&f=$pms_field&token=$pms_token&format=xml"; 
			$crot = @file_get_contents($gen4_url);
			break;
			
		    case 'MOVE':
			$gen4_url .= "&cmd=$pms_event&d=$pms_date&t=$pms_time&f=$pms_field&token=$pms_token&format=xml"; 
			$crot = @file_get_contents($gen4_url);
			break;
			
		    case 'CHANGE':
			$gen4_url .= "&cmd=$pms_event&d=$pms_date&t=$pms_time&f=$pms_field&token=$pms_token&format=xml"; 
			$crot = @file_get_contents($gen4_url);
			break;
		
		    case 'MSG':
			break;
			
		    case 'OCC':
			$gen4_url .= "&cmd=$pms_event&d=$pms_date&t=$pms_time&f=$pms_field&token=$pms_token&format=xml"; 
			$crot = @file_get_contents($gen4_url);
			break;
			
		    case 'OCCDETAIL':
			$gen4_url .= "&cmd=$pms_event&d=$pms_date&t=$pms_time&f=$pms_field&token=$pms_token&format=xml"; 
			$crot = @file_get_contents($gen4_url);
			break;
		
		    case 'OCCMONTH':
			$gen4_url .= "&cmd=$pms_event&d=$pms_date&t=$pms_time&f=$pms_field&token=$pms_token&format=xml"; 
			$crot = @file_get_contents($gen4_url);
			break;
			
		    case 'SYNCCEK':
			$gen4_url .= "&cmd=$pms_event&token=$pms_token&format=xml"; 
			$crot = @file_get_contents($gen4_url);
			break;
			
		    case 'SYNCDONE':
			$gen4_url .= "&cmd=$pms_event&token=$pms_token&format=xml"; 
			$crot = @file_get_contents($gen4_url);
			break;
		
		    case 'CEKINSYNC':
			$gen4_url .= "&cmd=$pms_event&d=$pms_date&t=$pms_time&f=$pms_field&token=$pms_token&format=xml"; 
			$crot = @file_get_contents($gen4_url);
			break;
			
		    case 'INITSYNC':
			$gen4_url .= "&cmd=$pms_event&token=$pms_token&format=xml"; 
			$crot = @file_get_contents($gen4_url);
			break;
		}
		
		/*END INSERT*/
		
			switch ($_GET['method']) {
				case 'send':
					$token = $_GET['token'];
						if($token == $tokenVHP){
							$command = $_GET['cmd'];
							$date 	 = $_GET['d'];
							$time	 = $_GET['t'];
							$field	 = $_GET['f'];
                            
                            if($command == "OCC" || $command == "OCCMONTH" || $command == "OCCDETAIL") {
                                
                                $query = "INSERT INTO  `vhp` (
                                            `id` ,
                                            `date` ,
                                            `command` ,
                                            `field1`
                                            )
                                            VALUES (
                                            NULL ,  '".mysql_real_escape_string($date.' '.$time)."', '".mysql_real_escape_string($command)."', '".mysql_real_escape_string($field)."');";
                                            
                                $go = mysql_query($query);
                                if ($go) {
                                    if($command == "OCC" || $command == "OCCMONTH") {
                                        $sqlCheck = "SELECT * FROM daily_occupancy WHERE DATE_FORMAT(closing_date, '%Y-%m-%d') = '".$date."' AND command = '".$command."'";
                                        $resultCheck = mysql_query($sqlCheck);
                                        $totalCheck = mysql_num_rows($resultCheck);
                                        
                                        $sql = "INSERT INTO daily_occupancy(closing_date, total_paying_room, command) VALUES('".$date.' '.$time."', ".$field.", '".$command."')";
                                        $res = mysql_query($sql);
                                        if (!$res) {
                                            $results = Array(
                                                'head' => Array(
                                                    'status' 		=> '0',
                                                    'error_number'	=> '603', 
                                                    'error_message' => 'Processing Data Failed. '.
                                                        'Probably wrong format supplied.'
                                                ),
                                                'body' => Array ()
                                            );
                                        } else {
                                            $results = Array(  
                                                'body' => Array (  
                                                    'id'    => mysql_insert_id(),  
                                                    'status' => '200',
                                                    'message'=> 'The request has succeeded'
                                                )  
                                            ); 
                                            
                                            
                                        
                                            if($command == "OCC" && $totalCheck == 0) {
                                                
                                                /* Data by internal query */
                                                //$yesterday = date("Y-m-d", mktime(0,0,0, date("m"), date("d")-1, date("Y")));
                                                $qLog = "SELECT room_rent.id, room_rent.rent_start, room_rent.compliment, guest.name, guest.salutation, room.number FROM ((room_rent LEFT JOIN guest ON room_rent.guestID=guest.id) LEFT JOIN room ON room_rent.roomID=room.id) WHERE room_rent.status = 1";
                                                $res = mysql_query($qLog);
                                                //print_r($res);
                                                while($item = mysql_fetch_array($res)) {
                                                    $id = $item['id'];
                                                    $rent_start = $item['rent_start'];
                                                    $compliment = $item['compliment'];
                                                    $name = $item['name'];
                                                    $salutation = $item['salutation'];
                                                    $number = $item['number'];
                                                    $qinsertlog = "INSERT INTO daily_occupancy_detail2(id, date, check_in, compliment, name, salutation, room_number, day) VALUES (NULL, '".$date."','".$rent_start."','".$compliment."', '".$name."','".$salutation."','".$number."','1')";
                                                    mysql_query($qinsertlog);
                                                }
                                            }
                                        }
                                       
                                    } else if($command == "OCCDETAIL") {
                                        $dt = explode("-", $date);
                                        $yesterday = date("Y-m-d", mktime(0,0,0, $dt[1], $dt[2]-1, $dt[0]));
                                        
                                        /* Data sent by VHP */
                                        $delimiter = "|";
                                        $split = explode($delimiter, $field);
                                        $field1 = $split[1];
                                        $field2 = $split[2];
                                        
                                        $sqlCheck = "SELECT * FROM daily_occupancy_detail WHERE send_date = '".$date."' AND name = '".$field1."' AND room_number = '".$field2."'";
                                        $resultCheck = mysql_query($sqlCheck);
                                        $totalCheck = mysql_num_rows($resultCheck);
                                        
                                        if($totalCheck == 0) {
                                            $sql = "INSERT INTO daily_occupancy_detail(id, date, name, room_number, day, send_date) VALUES(NULL, '".$yesterday."', '".mysql_real_escape_string($field1)."' ,'".$field2."','1', '".$date."')";
                                            $res = mysql_query($sql);
                                            if (!$res) {
                                                $results = Array(
                                                    'head' => Array(
                                                        'status' 		=> '0',
                                                        'error_number'	=> '603', 
                                                        'error_message' => 'Processing Data Failed. '.
                                                            'Probably wrong format supplied.'
                                                    ),
                                                    'body' => Array ()
                                                );
                                            } else {
                                                    $results = Array(  
                                                        'body' => Array (  
                                                            'id'    => mysql_insert_id(),  
                                                            'status' => '200',
                                                            'message'=> 'The request has succeeded'
                                                        )  
                                                    ); 
                                            }
                                        } else {
                                            $results = Array(  
                                                'body' => Array (  
                                                    'id'    => mysql_insert_id(),  
                                                    'status' => '200',
                                                    'message'=> 'The request has succeeded'
                                                )  
                                            ); 
                                        }
                                    }
                                }
                            } else {
                                $delimiter = "|";
                                $split = explode($delimiter, $field);
                                $field1 = $split[1];
                                $field2 = $split[2];
                                $field3 = $split[3];
                                $field4 = $split[4];
                                $field5 = $split[5];
                                $field6 = $split[6];
                                $field7 = $split[7];
                                $field8 = $split[8];
                                $field9 = $split[9];
                                $field10 = $split[10];
                                $field11 = $split[11];
                                $field12 = $split[12];
                                $field13 = $split[13];
                                $field14 = $split[14];
							
                                /*SQL Query*/
                                $qcek = "SELECT COUNT(id) AS count FROM `vhp` WHERE
                                         `date`= '".mysql_real_escape_string($date.' '.$time)."' AND
                                         `command` = '".mysql_real_escape_string($command)."' AND
                                         `field1` = '".mysql_real_escape_string($field1)."' AND
                                         `field2` = '".mysql_real_escape_string($field2)."' AND
                                         `field3` = '".mysql_real_escape_string($field3)."' AND
                                         `field4` = '".mysql_real_escape_string($field4)."' AND
                                         `field5` = '".mysql_real_escape_string($field5)."' AND
                                         `field6` = '".mysql_real_escape_string($field6)."' AND
                                         `field7` = '".mysql_real_escape_string($field7)."' AND
                                         `field8` = '".mysql_real_escape_string($field8)."' AND
                                         `field9` = '".mysql_real_escape_string($field9)."' AND
                                         `field10` = '".mysql_real_escape_string($field10)."' AND
                                         `field11` = '".mysql_real_escape_string($field11)."' AND
                                         `field12` = '".mysql_real_escape_string($field12)."' AND
                                         `field13` = '".mysql_real_escape_string($field13)."' AND
                                         `field14` = '".mysql_real_escape_string($field14)."'
                                ";
                                $cek = @mysql_query($qcek);
                                $count = mysql_fetch_assoc($cek);
                                //print_r($count);
                                if($count['count']>0){
                                    $results = Array(  
                                            'body' => Array (  
                                                'status' => '204',
                                                'message'=> 'Request Accepted'
                                            )  
                                        ); 
                                }elseif($count['count']==0){
                                    $query = "INSERT INTO  `vhp` (
                                            `id` ,
                                            `date` ,
                                            `command` ,
                                            `field1` ,
                                            `field2` ,
                                            `field3` ,
                                            `field4` ,
                                            `field5` ,
                                            `field6` ,
                                            `field7` ,
                                            `field8` ,
                                            `field9` ,
                                            `field10` ,
                                            `field11` ,
                                            `field12` ,
                                            `field13` ,
                                            `field14`
                                            )
                                            VALUES (
                                            NULL ,  '".mysql_real_escape_string($date.' '.$time)."',  '".mysql_real_escape_string($command)."',  '".mysql_real_escape_string($field1)."',  '".mysql_real_escape_string($field2)."',  '".mysql_real_escape_string($field3)."',  '".mysql_real_escape_string($field4)."',  '".mysql_real_escape_string($field5)."',  '".mysql_real_escape_string($field6)."',  '".mysql_real_escape_string($field7)."',  '".mysql_real_escape_string($field8)."',  '".mysql_real_escape_string($field9)."',  '".mysql_real_escape_string($field10)."',  '".mysql_real_escape_string($field11)."',  '".mysql_real_escape_string($field12)."',  '".mysql_real_escape_string($field13)."',  '".mysql_real_escape_string($field14)."'
                                            );";
                                        //echo $query;
                                    
                                        if (!$go = @mysql_query($query)) {
                                            $results = Array(
                                                'head' => Array(
                                                    'status' 		=> '0',
                                                    'error_number'	=> '603', 
                                                    'error_message' => 'Processing Data Failed. '.
                                                        'Probably wrong format supplied.'
                                                ),
                                                'body' => Array ()
                                            );
                                        } else {
                                            $results = Array(  
                                                'body' => Array (  
                                                    'id'    => mysql_insert_id(),  
                                                    'status' => '200',
                                                    'message'=> 'The request has succeeded'
                                                )  
                                            ); 
                                        }

                                
                                }
                            }
                        } elseif($token != $tokenVHP){
                            $results = Array(
                                    'head' => Array(
                                        'status' 		=> '0',
                                        'error_number'	=> '401', 
                                        'error_message' => 'Authentication Failed. '.
                                            'Probably wrong token supplied.'
                                    ),
                                    'body' => Array ()
                                );
                        }
						break;

				case 'request':
					$token = $_GET['token'];
						if($token == $tokenVHP){
							$command = $_GET['cmd'];
							$field	 = $_GET['q'];
							$date 	 = $_GET['d'];
							$time	 = $_GET['t'];
							$field	 = $_GET['f'];
							switch ($command) {
								case 'TRXCEK':
                                    /*Jika $command = 'TRXCEK', cari data transaksi yang belum dikirim (status=0) lalu kembalikan dalam bentuk response*/
                                    $query = "SELECT id, resNr, resLnNr, article, number, price, order_datetime FROM `transaction` WHERE status = 0";
                                    if (!$go = @mysql_query($query)) {
                                        $results = Array(
                                            'head' => Array(
                                                'status' 		=> '0',
                                                'error_number'	=> '603', 
                                                'error_message' => 'Processing Data Failed. '.
                                                    'Probably wrong format supplied.'
                                            ),
                                            'body' => Array ()
                                        );
                                    } else {
                                        /*jika hasil kosong, beri informasi tidak ada data*/
                                        if(mysql_num_rows($go)>0){
                                            while ($fetch = mysql_fetch_assoc($go)){
                                                $data[] = $fetch;

                                            }
                                            $results = Array(  
                                                
                                                'body' => Array (  
                                                    'status' => '200',
                                                    'message'=> 'The request has succeeded',
                                                    
                                                ),
                                                'content' => $data
                                            );
                                        }else{
                                            $results = Array(  
                                                'body' => Array (  
                                                    'status' => '204',
                                                    'message'=> 'No Content'
                                                )  
                                            );
                                        }
                                        
                                        mysql_free_result($go);
                                    }

                                    break;

								case 'TRXDONE':
                                    $comma = ",";
                                    $trxID = explode($comma,$field);
                                    /*update tabel transaction set status =1*/
                                    foreach ($trxID as $item) {
                                        $query = "UPDATE transaction SET `status` = 1 WHERE id = ".$item."";
                                        @mysql_query($query);
                                    }
                                    $results = Array(  
                                            'body' => Array (  
                                                'status' => '202',
                                                'message'=> 'The request has accepted'
                                            )  
                                        );
                                    break;

								case 'BILLVIEWCEK':
									/*Jika $command = 'BILLVIEWCEK', cari data request billing yang belum dikirim (status=0) lalu kembalikan dalam bentuk response*/
									$query = "SELECT id AS request_billingID, number, resNr, resLnNr, individualFlag FROM `request_billing` WHERE status = 0";
									if (!$go = @mysql_query($query)) {
                                        $results = Array(
                                            'head' => Array(
                                                'status' 		=> '0',
                                                'error_number'	=> '603', 
                                                'error_message' => 'Processing Data Failed. '.
                                                    'Probably wrong format supplied.'
                                            ),
                                            'body' => Array ()
                                        );
                                    } else {
                                        /*jika hasil kosong, beri informasi tidak ada data*/
                                        if(mysql_num_rows($go)>0){
                                            while ($fetch = mysql_fetch_assoc($go)){
                                            $data[] = $fetch;

                                            }
                                            $results = Array(  
                                                
                                                'body' => Array (  
                                                    'status' => '200',
                                                    'message'=> 'The request has succeeded',
                                                    
                                                ),
                                                'content' => $data
                                            );
                                        }else{
                                            $results = Array(  
                                                'body' => Array (  
                                                    'status' => '204',
                                                    'message'=> 'No Content'
                                                )  
                                            );
                                        }
                                        
                                        mysql_free_result($go);
                                    }
                                    break;

								case 'BILLVIEWDONE':
                                    $delimiter = "|";
                                    $split = explode($delimiter, $field);
                                    foreach ($split as $key => $value) {
                                        $comma = ",";
                                        $billID = explode($comma,$value);
                                        /*Query Untuk Insert data ke tabel bill_view*/
                                        $query = "INSERT INTO bill_view SET `request_billingID` = ".$billID[0].", `article` = ".$billID[1].", `price` = ".$billID[2]."";
                                        @mysql_query($query);
                                        
                                    }
                                    /*Query Untuk Update status di tabel request_billing*/
                                    $qRequestBilling = "UPDATE `request_billing` SET `status` = 1 WHERE `id` = ".$billID[0]."";
                                    @mysql_query($qRequestBilling);
                                    $results = Array(  
                                            'body' => Array (  
                                                'status' => '202',
                                                'message'=> 'The request has accepted'
                                            )  
                                        );
                                    break;

								case 'SYNCCEK':
                                    $query = "SELECT status FROM `sync_status`";
                                    if (!$go = @mysql_query($query)) {
                                        $results = Array(
                                            'head' => Array(
                                                'status' 		=> '0',
                                                'error_number'	=> '603', 
                                                'error_message' => 'Processing Data Failed. '.
                                                    'Probably wrong format supplied.'
                                            ),
                                            'body' => Array ()
                                        );
                                    }else{
                                        /*jika hasil 0, response No Sync, jika hasil 1, response Need Sync*/
                                        $fetch = mysql_fetch_assoc($go);
                                        if($fetch['status']==0){
                                            $response = "No Sync";
                                        }elseif($fetch['status']==1){
                                            $response = "Need Sync";
                                        }

                                        $return = Array($fetch['status'],$response);  
                                        $results = Array(  
                                            'body' => Array (
                                                'status' => '200',  
                                                'code'    => $return[0],  
                                                'message' => $return[1]  
                                            )  
                                        ); 
                                        mysql_free_result($go);
                                    }
                                    break;
								
								case 'TRXSYNCCEK':
                                    $query = "SELECT id, resNr, resLnNr, article, number, price, order_datetime FROM `transaction_sync`";
                                    if (!$go = @mysql_query($query)) {
                                        $results = Array(
                                            'head' => Array(
                                                'status' 		=> '0',
                                                'error_number'	=> '603', 
                                                'error_message' => 'Processing Data Failed. '.
                                                    'Probably wrong format supplied.'
                                            ),
                                            'body' => Array ()
                                        );
                                    } else {
                                        /*jika hasil kosong, beri informasi tidak ada data*/
                                        if(mysql_num_rows($go)>0){
                                            while ($fetch = mysql_fetch_assoc($go)){
                                            $data[] = $fetch;

                                            }
                                            $results = Array(  
                                                
                                                'body' => Array (  
                                                    'status' => '200',
                                                    'message'=> 'The request has succeeded',
                                                    
                                                ),
                                                'content' => $data
                                            );
                                        }else{
                                            $results = Array(  
                                                'body' => Array (  
                                                    'status' => '204',
                                                    'message'=> 'No Content'
                                                )  
                                            );
                                        }
                                        
                                        mysql_free_result($go);
                                    }
                                    break;

								case 'TRXSYNCDONE':
                                    $comma = ",";
                                    $trxID = explode($comma,$field);
                                    /*update tabel transaction set status =1*/
                                    foreach ($trxID as $item) {
                                        $query = "UPDATE transaction_sync SET `status` = 1 WHERE id = ".$item."";
                                        @mysql_query($query);
                                    }
                                    $results = Array(  
                                            'body' => Array (  
                                                'status' => '202',
                                                'message'=> 'The request has accepted'
                                            )  
                                        );
                                    break;

								case 'INITSYNC':
                                    $qvhp = "TRUNCATE TABLE `vhp`";
                                    $execvhp = @mysql_query($qvhp);

                                    $qroomrent = "UPDATE room_rent SET `status` = 2 WHERE `status` = 1";
                                    $execroomrent = @mysql_query($qroomrent);

                                    $qtrx = "UPDATE transaction SET `status` = 2";
                                    $exectrx = @mysql_query($qtrx);

                                    $qroom = "UPDATE room SET `status` = 0";
                                    $execroom = @mysql_query($qroom);

                                    if($execroomrent && $exectrx && $execroom){
                                        $results = Array(  
                                            'body' => Array (  
                                                'status' => '200',
                                                'message'=> 'Ready To Sync'
                                            )  
                                        );
                                    }
                                    break;

								case 'SYNCDONE':
                                    $query = "UPDATE sync_status SET `status` = 0";
                                    $go = @mysql_query($query);
                                    $results = Array(  
                                                'body' => Array (  
                                                    'status' => '200',
                                                    'message'=> 'The request has succeeded'
                                                )  
                                            );
                                    break;

								default:
									$results = Array(
                                        'head' => Array(
                                            'status' 		=> '0',
                                            'error_number'	=> '420', 
                                            'error_message' => 'Command Failure.'.
                                                'Wrong or Unknown Command.'
                                        ),
                                        'body' => Array ()
                                    );
                                    $errors=1;
							}

						}elseif($token != $tokenVHP){
							$results = Array(
									'head' => Array(
										'status' 		=> '0',
										'error_number'	=> '401', 
										'error_message' => 'Authentication Failed. '.
											'Probably wrong token supplied.'
									),
									'body' => Array ()
								);
						}

				break;

				default:
				$results = Array(
				'head' => Array(
					'status' 		=> '0',
					'error_number'	=> '420', 
					'error_message' => 'Method Failure.'.
						'Wrong or Unknown Method.'
				),
				'body' => Array ()
			);
			$errors=1;

			}
        }
		
		mysql_close();

		switch ($_GET['format']) {
			case 'xml-old' :
					@header ("content-type: text/xml charset=utf-8");
					$xml = new XmlWriter();
					$xml->openMemory();
					$xml->startDocument('1.0', 'UTF-8');
					$xml->startElement('callback');
					$xml->writeAttribute('xmlns:xsi','http://www.w3.org/2001/XMLSchema-instance');
					$xml->writeAttribute('xsi:noNamespaceSchemaLocation','schema.xsd');
					function write(XMLWriter $xml, $data){
							foreach($data as $key => $value){
									if(is_array($value)){
											$xml->startElement($key);
											write($xml, $value);
											$xml->endElement();
											continue;
									}
									$xml->writeElement($key, $value);
							}
					}
					write($xml, $results);

					$xml->endElement();
					echo $xml->outputMemory(true);
				break;
			case 'xml' :
					header ("content-type: text/xml charset=utf-8");                   
					$xml = new XmlWriter();
					$xml->openMemory();
					$xml->startDocument('1.0', 'UTF-8');
					$xml->startElement('callback');
					$xml->writeAttribute('xmlns:xsi','http://www.w3.org/2001/XMLSchema-instance');
					$xml->writeAttribute('xsi:noNamespaceSchemaLocation','schema.xsd');
					foreach($results as $key => $value){
						$xml->startElement($key);
						foreach ($value as $key1 => $value1) {
							$xml->writeElement($key1, $value1);
							if($key=="content"){

								$xml->startElement('data');
								foreach ($value1 as $key2 => $value2) {
									# code...
									$xml->writeElement($key2, $value2);
									//print_r($value2);
								}
								
								$xml->endElement();

							}
							
							
						}
						$xml->endElement();
					}
				

					$xml->endElement();
					echo $xml->outputMemory(true);
					
				break;
			case 'json' :
					//header ("content-type: text/json charset=utf-8");
					echo json_encode($results);
				break;
			case 'php' :
					header ("content-type: text/php charset=utf-8");  
					echo serialize($results);  
				break;
		}
?>