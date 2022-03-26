<?php

namespace modulo3;

require __DIR__ . '/../../vendor/autoload.php';

if (count($argv) !== 2 || strlen(trim($argv[1])) < 0 )
{
    echo ("Usage: php.exe $argv[0] <binaryString>");
    exit(1);
}

try {
    $mod3 = new Modulo3($argv[1]);
    $result = $mod3->run();
    print($mod3->GetResult());
}
catch (\Exception $ex) {
    if ($mod3 instanceof Modulo3)
    {
        $error = $mod3->GetLastError();
    }
    print($ex->getMessage());
}

if (!empty($error))
    print($error);

exit(0);
