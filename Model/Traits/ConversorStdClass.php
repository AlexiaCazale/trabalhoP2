<?php

trait ConversorStdClass
{
    public static function stdClassToModelClass(stdClass $stdClassObject, string $targetClassName): ?object
    {
        if (!class_exists($targetClassName)) {
            trigger_error("Classe alvo '{$targetClassName}' não encontrada para conversão.", E_USER_WARNING);
            return null;
        }

        $constructorArgs = [];
        foreach ((array)$stdClassObject as $dbColumnName => $value) {
            $parts = explode('_', $dbColumnName);
            if (count($parts) > 1) {
                 array_pop($parts); // Remove o último elemento 
            }
            $modelPropertyName = implode('_', $parts); 
            $modelPropertyName = lcfirst(str_replace('_', '', ucwords($modelPropertyName, '_')));

            // Adiciona o valor ao array de argumentos nomeados
            $constructorArgs[$modelPropertyName] = $value;
        }

        try {
            return new $targetClassName(...$constructorArgs);
        } catch (\ArgumentCountError $e) {
             // Captura erro específico se faltarem argumentos no construtor
             trigger_error("Erro de Argumentos no construtor de '{$targetClassName}': " . $e->getMessage(), E_USER_WARNING);
             return null;
        } catch (\TypeError $e) {
             // Captura erro de tipo nos argumentos
             trigger_error("Erro de Tipo nos argumentos do construtor de '{$targetClassName}': " . $e->getMessage(), E_USER_WARNING);
             return null;
        } catch (\Throwable $e) {
            trigger_error("Não foi possível instanciar a classe '{$targetClassName}' de stdClass: " . $e->getMessage(), E_USER_WARNING);
            return null;
        }
    }
}
?>