<?php
    session_start();
    function validarCedula($numero = '')
    {
        // fuerzo parametro de entrada a string
        $numero = (string)$numero;
        // validaciones
        try {
            validarInicial($numero, '10');
            validarCodigoProvincia(substr($numero, 0, 2));
            algoritmoModulo10(substr($numero, 0, 9), $numero[9]);
        } catch (Exception $e) {
            $_SESSION['errorRE'] = $e->getMessage();
            return false;
        }
        return true;
    }

    function validarInicial($numero, $caracteres)
    {
        if (empty($numero)) {
            throw new Exception('Campo cedula no puede estar vacio');
        }
        if (!ctype_digit($numero)) {
            throw new Exception('Campo cedula solo puede tener dígitos');
        }
        if (strlen($numero) != $caracteres) {
            throw new Exception('Campo cedula debe tener '.$caracteres.' caracteres');
        }
        return true;
    }

    function validarCodigoProvincia($numero)
    {
        if ($numero < 0 OR $numero > 24) {
            throw new Exception('Cedula incorrecta.');
        }
        return true;
    }

    function algoritmoModulo10($digitosIniciales, $digitoVerificador)
    {
        $arrayCoeficientes = array(2,1,2,1,2,1,2,1,2);
        $digitoVerificador = (int)$digitoVerificador;
        $digitosIniciales = str_split($digitosIniciales);
        $total = 0;
        foreach ($digitosIniciales as $key => $value) {
            $valorPosicion = ( (int)$value * $arrayCoeficientes[$key] );
            if ($valorPosicion >= 10) {
                $valorPosicion = str_split($valorPosicion);
                $valorPosicion = array_sum($valorPosicion);
                $valorPosicion = (int)$valorPosicion;
            }
            $total = $total + $valorPosicion;
        }
        $residuo =  $total % 10;
        if ($residuo == 0) {
            $resultado = 0;
        } else {
            $resultado = 10 - $residuo;
        }
        if ($resultado != $digitoVerificador) {
            throw new Exception('Cedula incorrecta.');
        }
        return true;
    }
