<?php

$host = $_GET['ip'];
$count = 1;
$output = exec("ping -c $count -q $host");

// Procura pela linha que contém os dados estatísticos
$lines = explode("\n", $output);
foreach ($lines as $line) {
  if (strpos($line, "min/avg/max") !== false) {
    $stats = $line;
    break;
  }
}

// Extrai apenas os dados finais da estatística
$pattern = '/min\/avg\/max\/mdev = ([\d\.]+)\/([\d\.]+)\/([\d\.]+)\/([\d\.]+) ms/';
if (preg_match($pattern, $stats, $matches)) {
  $min = $matches[1];
  $avg = $matches[2];
  $max = $matches[3];
  $mdev = $matches[4];
  
  // Imprime os dados finais
  echo "Tempo de resposta: $avg ms\n";
}else{
    echo 'Offline';
}