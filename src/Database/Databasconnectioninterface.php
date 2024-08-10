<?php

namespace App\Database;

interface Databasconnectioninterface
{
    public function connection(): \PDO;
}