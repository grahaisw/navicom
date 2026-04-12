<?php
$conn = pg_connect("host=localhost dbname=postgres user=postgres password=apalah");
if (!$conn) {
    echo "Connection failed: " . pg_last_error();
} else {
    echo "Connected successfully!";
}
?>