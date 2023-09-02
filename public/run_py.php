<?php
$command = escapeshellcmd('py .\barcode_generator.py');
$output = shell_exec($command);
echo $output;
