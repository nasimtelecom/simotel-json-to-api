<?php

namespace App\Controller;

class MainController
{
    public function index()
    {
        $jsonFile = __DIR__ . "/../../simotel-json-api/simotel.json";
        $jsonContent = json_decode(file_get_contents($jsonFile), true);

        $apiArray = $this->jsonToSimotelApiArray($jsonContent);

        $data = varexport($apiArray, true);

        try {
            $this->exportToFile($data);
            echo "simotel api list maped to export/simotelApiList.php";
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }


    private function jsonToSimotelApiArray($json)
    {
        $items = $json["item"];
        $api=[];
        foreach ($items as $item) {
            $capi=[];
            $capi["address"]=$item["name"];
            $capi["method"]=$item["request"]["method"];
            $name = str_replace("/", "_", $item["name"]);
            $api[$name]=$capi;
        }
        return $api;
    }

    private function exportToFile($content)
    {
        if (!is_dir(__DIR__ . "/../../export")) {
            mkdir(__DIR__ . "/../../export");
        }

        $exportFileName = __DIR__ . "/../../export/simotelApiList.php";
        file_put_contents($exportFileName, "<?php \r\n return ".$content.";");

        return true;
    }
}
