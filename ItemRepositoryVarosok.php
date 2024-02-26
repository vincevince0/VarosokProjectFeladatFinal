<?php
class ItemRepositoryVarosok
{
    private $mysqli;

    public function __construct()
    {
        $this->mysqli = new mysqli("localhost", "root", "", "zip_codes");
        $this->mysqli->set_charset("utf8mb4");
        if ($this->mysqli->connect_error) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }
    }

    public function getAllCounties()
    {
        $counties = [];

        $sql = "SELECT * FROM counties";
        $result = $this->mysqli->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $counties[] = $row;
            }
        }

        return $counties;
    }

    public function getAllCities()
    {
        $cities = [];

        $sql = "SELECT * FROM cities";
        $result = $this->mysqli->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $cities[] = $row;
            }
        }

        return $cities;
    }

    public function getAllFlags()
    {
        $cimerek = [];

        $sql = "SELECT * FROM cimerek";
        $result = $this->mysqli->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $cimerek[] = $row;
            }
        }

        return $cimerek;
    }




    public function searchCity($needle)
    {
        $sql = "SELECT * FROM cities WHERE (city) LIKE '%$needle%'";
        $stmt = $this->mysqli->prepare($sql);
       // $stmt->bind_param('s', $needle);
       $result =$this->mysqli->query($sql);
      
       if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cities[] = $row;
        }
       }

       return $cities;
    }



    
    
    public function getCityByCountyId($countyId)
    {
        $cities = [];
        
        $sql = "SELECT * FROM cities WHERE countyId = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $countyId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
            $cities[] = $row;
            }
        }
        return  $cities;
        
    }

    public function getCountyFlagById($countyId)
    {
        $cimerek = [];
        
        $sql = "SELECT cimer,zaszlo FROM cimerek WHERE countyId = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $countyId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
            $cimerek[] = $row;
            }
        }
        return  $cimerek;
        
    }

    public function deleteCity($countyId)
    {
        $sql = "DELETE FROM cities WHERE countyId = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('i', $countyId);

        $stmt->execute();
    }

    public function saveCity($city)
    {
        $sql = "INSERT INTO `cities`(`city`) VALUES (?)";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("s", $city);
        $stmt->execute();
        $stmt->close();
    }

    public function updateCity($countyId, $city)
    {
        $sql = "UPDATE cities SET name = ? WHERE id = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('si', $city, $countyId);

        $stmt->execute();
    }

    public function closeConnection()
    {
        $this->mysqli->close();
    }


}