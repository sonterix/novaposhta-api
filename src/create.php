<?php

require_once 'HTTP/Request2.php';

class Create
{
    // DB data
    private $dbHost = 'localhost';
    private $dbName = 'api_np';
    private $dbUser = 'root';
    private $dbPass = '380636890256';
    private $dbChar = 'utf8';
    private $dbh;

    // Data from json
    private $json;
    private $ttnArr;
    private $createdArr;
    private $statusArr;
    private $ttn;
    private $created;

    private $status = 0;
    private $date;
    private $post;
    private $response;

    function __construct() 
    {
       
        // Sample uses the Apache HTTP client from HTTP Components
        $request = new Http_Request2('http://testapi.novaposhta.ua/v2.0/en/save_warehouse/json/');
        $url = $request->getUrl();

        // Connect to DB and get data
        $this->connectDb();
        $this->getDataFromPost();

        $headers = array(
            'Content-Type' => 'application/json',
        );
        
        $request->setHeader($headers);
        
        // Request headers
        $parameters = [
           '{
                "modelName":"InternetDocument",
                "calledMethod":"save"
            }'
        ];

        $url->setQueryVariables($parameters);
        $request->setMethod(HTTP_Request2::METHOD_POST);

        // Request body
        $request->setBody(
            '{  
                "apiKey": "5bd4dd448fed718052dc3d242ee4337f",
                "modelName":"InternetDocument",
                "calledMethod":"save",
                "methodProperties":{  
                    "NewAddress":"1",
                    "PayerType":"Recipient",
                    "PaymentMethod":"Cash",
                    "CargoType":"Parcel",
                    "VolumeGeneral":"0.1",
                    "Weight": "'.$this->post['weight'].'",
                    "ServiceType":"WarehouseWarehouse",
                    "SeatsAmount":"1",
                    "Description":"Посылка",
                    "Cost": "'.$this->post['cost'].'",
                    "CitySender":"e71629ab-4b33-11e4-ab6d-005056801329",
                    "SenderAddress":"08eb8369-a2c6-11e7-becf-005056881c6b",
                    "Sender":"81985550-a1e8-11e7-8ba8-005056881c6b",
                    "ContactSender":"819d974e-a1e8-11e7-8ba8-005056881c6b",
                    "SendersPhone":"380636890256",
                    "RecipientCityName": "'.$this->post['city'].'",
                    "RecipientArea": "",
                    "RecipientAreaRegions":"",
                    "RecipientAddressName": "'.$this->post['npNumb'].'",
                    "RecipientHouse":"",
                    "RecipientFlat":"",
                    "RecipientName": "'.$this->post['name'].'",
                    "RecipientType":"PrivatePerson",
                    "RecipientsPhone": "'.$this->post['phone'].'",
                    "DateTime": "'.$this->date.'"
                }
            }'
        );
        
        // Send POST to novaposhta API
        try
        {
            $this->response = $request->send();
            //echo '<pre>' . $this->response->getBody();
        }
        catch (HttpException $ex)
        {
            //echo $ex;
        }

        $this->getDataFromResponse();
        $this->addToDb($this->statusArr[1]);

        // Show template
        require_once 'status.php';
    }

    // Get and clear data frop POST
    function getDataFromPost()
    {
        $this->date = date("d.m") . '.2018';
        $this->post = $_POST;
        $length = count($this->post);

        foreach($this->post as $value){
            $value = $this->clear($value);
        }
        $this->post['phone'] = $this->clearPhone($this->post['phone']);
    }

    // Get data from response Novaposhta
    function getDataFromResponse()
    {
        $this->json = explode(',', $this->response->getBody());
        $this->ttnArr = explode(":", $this->json['4']);
        $this->createdArr = explode(":", $this->json['3']);
        $this->statusArr = explode(":", $this->json['0']);

        $this->ttn = substr($this->ttnArr[1], 1, 14);
        $this->created = substr($this->createdArr[1], 1, 10);
    }

    // Connect to DB
    function connectDb()
    {
        $dsn = 'mysql:host='.$this->dbHost.';dbname='.$this->dbName.';charset='.$this->dbChar;
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => FALSE,
        ];
        $this->dbh = new PDO($dsn, $this->dbUser, $this->dbPass, $opt);
    }
    
    // Add data to DB
    function addToDb($statusArr)
    {
        if($statusArr == 'true'){
            $this->status = 1;
            
            $insert = 'name, phone, city, secession, weight, cost, status, np_status, np_id, created_at';
            $value = "'".$this->post['name']."', '".$this->post['phone']."', '".$this->post['city']."', '".$this->post['npNumb']."', '".$this->post['weight']."', '".$this->post['cost']."', '$this->status', '$statusArr', '$this->ttn', '$this->created'";

            $sth = $this->dbh->prepare("INSERT INTO orders (".$insert.") VALUES (".$value.")");
            $sth->execute();
        }

    }

    // Remove "+" from Phone field
    function clearPhone($data){
        if(substr($data, 0, 1) == '+'){
            $data = substr($data, 1);
        }
        return $data;
    }
    
    // Clear data
    function clear($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

ini_set('display_errors', 1);
$c = new Create();