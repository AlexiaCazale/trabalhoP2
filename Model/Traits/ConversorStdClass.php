<?php

trait ConversorStdClass
{
    public static function stdClassToModelClass(stdClass $stdClassObject, string $targetClassName): ?object
    {
        if (!class_exists($targetClassName)) {
            trigger_error("Target class '{$targetClassName}' not found for conversion.", E_USER_WARNING);
            return null;
        }

        $constructorArgs = [];
        foreach ((array)$stdClassObject as $dbColumnName => $value) {
            // Pega apenas o primeiro nome da propriedade do banco de dados.
            $modelPropertyName = explode('_', $dbColumnName)[0];
            $constructorArgs[$modelPropertyName] = $value;
        }

        try {
            return new $targetClassName(...$constructorArgs);
        } catch (\Throwable $e) {
            trigger_error("Não foi possível instanciar a classe '{$targetClassName}' de stdClass: " . $e->getMessage(), E_USER_WARNING);
            return null;
        }
    }
}
?>