<?php 
class Connection
{
    private static $serverName = 'dpg-cm42hn6n7f5s73bsiq90-a.singapore-postgres.render.com';
    private static $port        = "5432";
    private static $userName = 'root';

    private static $password = 'J5wBU4ZErunyboy6yFVdFi5nA1mDJV0U';

    private static $db = 'bigdata_muiv';

    private static $connection = null;

    public static function setConnection(
        $serverName,
        $port,
        $userName,
        $password,
        $db
    )
    {
        static::$serverName = $serverName;
        static::$port       = $port;
        static::$userName   = $userName;
        static::$password   = $password;
        static::$db         = $db;

        $connectionStr = sprintf(
          "pgsql:host=%s;port=%s;dbname=%s;", 
          static::$serverName, 
          static::$port,
          static::$db
        );

        try {
            static::$connection = new PDO($connectionStr , static::$userName, static::$password);
            // set the PDO error mode to exception
            static::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          } catch(PDOException $e) {
            // echo "Connection failed: " . $e->getMessage();
            throw $e;
          }
    }

    public static function getConnection()
    {
      if (is_null(static::$connection)) {
          throw new InvalidArgumentException();
      }
      return static::$connection;
    }
}

?>