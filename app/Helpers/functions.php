<?php

    function generateToken (): string
    {
        $numberBytes = 3;

        $bytes = random_bytes($numberBytes);
        return bin2hex($bytes);
    }
