# Documentação da TaskHub

## Singleton e Composite
### Singleton
É um padrão de projeto de software definido por uma classe que não pode ser reinstânciada, ou seja, um único objeto é criado e utilizado durante todo o funcionamento. Nesse projeto, é utilizado para a conexão com o banco de dados. 

### Composite
Composite é um padrão de projeto usado para formar objetos a partir da união de outros objetos similares numa estrutura de árvore partes-todo. Nesse projeto, é utilizada para criação de alguns elementos gráficos.


## Utilização de Interfaces e Traços
### Interfaces
Interfaces são utilizadas para construir "contratos" que definem métodos que devem, obrigatóriamente, ser implementados numa classe. As interfaces também podem ser utilizadas para possibilitar o polimorfismo, o qual abstrai a estrutura de alguns componente.

#### Polimorfismo
Conceito de OOP que visa criar estruturas únicas que podem processar diferentes tipos de objetos. As interfaces são utilizadas para definir que, ao invés de passar um parâmetro tipado com uma classe, uma função aceite qualquer objeto que contenha as assinaturas implementadas por ela.

### Traços 
Os traços são usados para implementar propriedades e métodos à uma classe. São utilizados, nesse projeto, para reduzir código repetido entre várias classes. Em alguns casos, implementam os métodos definidos pelas interfaces.  

## Classes abstratas
Classes abstratas determinam propriedades e métodos de uma classe. Essa classe não pode ser instânciada diretamente, para ser utilizada ela deve ser herdada (<code>extends</code>) por outra classe. Nesse projeto, é utilizada, por exemplo, para definir características e funcionalidades inatas para todos os componentes. 

## Estrutura para documentação dentro do código

```php
/**
     * Texto que explica a função ou método.
     *
     * @param Tipo $parametro
     * @return string|null Valor de retorno.
     */
```

<br>
<h2>Diagramas</h2>

Diagrama de classes **Adicionar os métodos**
```mermaid 
classDiagram
    class Workspace{
        int id_workspace
        date criacao_workspace
        Usuario[] usuarios_workspace
        Atividade[] atividades_workspace
    }

    class Atividade{
        int id_atividade
        string titulo_atividade
        string texto_atividade
        Usuario[] usuarios_atividade 
    }

    class Usuario{
        int id_usuario
        string nome_usuario
        Workspace[] workspaces_usuario
        Atividade[] atividades_usuario
    } 

    Workspace o--o Atividade
    Workspace o--o Usuario
    Atividade o--o Usuario

```


Diagrama de relacionamentos (banco de dados)
```mermaid
erDiagram
    WORKSPACE 1--1 MEMBRO_WORKSPACE : Está_em
    USUARIO 1+--1 MEMBRO_WORKSPACE : Faz_parte_de

    ATIVIDADE 1--1 MEMBRO_ATIVIDADE : Está_em
    USUARIO 1+--1 MEMBRO_ATIVIDADE : Faz_parte_de

    ATIVIDADE 1--0+ COMENTARIO : Em
    USUARIO 1--0+ COMENTARIO : Fez

    WORKSPACE {
        int id_workspace
        date criacao_workspace
    }

    MEMBRO_WORKSPACE {
        int id_membro_workspace
        int id_workspace_fk
        int id_usuario_fk
    }

    ATIVIDADE {
        int id_atividade
        string titulo_atividade
        string texto_atividade
        int id_workspace_fk
    }

    MEMBRO_ATIVIDADE {
        int id_em_atividade
        int id_usuario_fk
        int id_atividade_fk
    } 

    USUARIO {
        int id_usuario
        string nome_usuario
    } 

    COMENTARIO {
        int id_comentario
        string texto_comentario
        int id_atividade_fk
        int id_usuario_fk
    }
```

