<?php
require_once('database.php');
echo PHP_EOL . 'start dump' . PHP_EOL;
$date = date('y-m-d');
$db = new Database('localhost','dzqoqnoa_cms','AmEsadS173', 'dzqoqnoa_cms');

//get all of the tables
$tables = array();
$result = $db->query('SHOW TABLES');
while($row = mysqli_fetch_row($result))
{
    $tables[] = $row[0];
}
$return = '';
//cycle through
foreach($tables as $table)
{
    $result = $db->query('SELECT * FROM '.$table);
    $num_fields = mysqli_num_fields($result);

    echo PHP_EOL . $table . PHP_EOL;

    $return.= 'DROP TABLE '.$table.';';
    $row2 = mysqli_fetch_row($db->query('SHOW CREATE TABLE '.$table));
    $return.= "\n\n".$row2[1].";\n\n";

    for ($i = 0; $i < $num_fields; $i++)
    {
        echo PHP_EOL . '.';
        while($row = mysqli_fetch_row($result))
        {
            $return.= 'INSERT INTO '.$table.' VALUES(';
            for($j=0; $j<$num_fields; $j++)
            {
                $row[$j] = addslashes($row[$j]);
                $row[$j] = preg_replace("/\\n/","/\\\\n/",$row[$j]);
                if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                if ($j<($num_fields-1)) { $return.= ','; }
            }
            $return.= ");\n";
        }
    }
    echo '.' . PHP_EOL;
    $return.="\n\n\n";
}

//save file
$handle = fopen(date('Y-m-d').'.sql','w+');
fwrite($handle,$return);
fclose($handle);
//escapeshellcmd('mysqldump --user=dzqoqnoa_cms --password=ST1.f,bK\(9m6 --host=localhost dzqoqnoa_cms > /home/dzqoqnoa/db_backup/'.$date.'.sql');
echo PHP_EOL . 'finished dump' . PHP_EOL;