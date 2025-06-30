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

<h2>Diagramas</h2>

Diagrama de classes
```mermaid 
classDiagram
    direction LR

    class IAtividade {
        <<Interface>>
        +getAtividades(): array
        +setAtividades(Atividade atividade): void
    }

    class IUsuario {
        <<Interface>>
        +getUsuarios(): array
        +setUsuarios(Usuario usuario): void
    }

    class TemAtividade {
        <<Trait>>
        -atividades: array
        +getAtividades(): array
        +setAtividades(Atividade atividade): void
    }

    class TemUsuario {
        <<Trait>>
        -usuarios: array
        +getUsuarios(): array
        +setUsuarios(Usuario usuario): void
        +limparUsuarios(): void
    }

    class Usuario {
        -id: int
        -nome: string
        -email: string
        -senha: string
        -avatar: string
        -workspaces: array
        -ativo: bool
        +get/set...()
    }
    Usuario ..|> IAtividade: implements
    Usuario ..> TemAtividade: uses

    class Workspace {
        -id: int
        -nome: string
        -descricao: string
        -ativo: bool
        -admin: Usuario
        +get/set...()
    }
    Workspace ..|> IUsuario: implements
    Workspace ..|> IAtividade: implements
    Workspace ..> TemUsuario: uses
    Workspace ..> TemAtividade: uses

    class Atividade {
        -id: int
        -nome: string
        -dataEntrega: DateTime
        -dataCriacao: DateTime
        -descricao: string
        -workspace: Workspace
        -comentarios: array
        -ativo: bool
        -concluido: bool
        -dataConcluido: DateTime
        +get/set...()
    }
    Atividade ..|> IUsuario: implements
    Atividade ..> TemUsuario: uses

    class Comentario {
        -id: int
        -texto: string
        -usuario: Usuario
        +get/set...()
    }

    Workspace "1" -- "0..*" Atividade : contém
    Workspace "1" -- "1" Usuario : "é administrado por"
    Workspace "1" -- "0..*" Usuario : "possui membros"
    Atividade "1" -- "0..*" Usuario : "possui membros"
    Atividade "1" -- "1" Workspace : pertence a
    Atividade "1" -- "0..*" Comentario : possui
    Usuario "1" -- "0..*" Comentario : cria
```


Diagrama de relacionamentos (banco de dados)
```mermaid
erDiagram
    USUARIO {
        int id_usuario PK
        varchar(200) nome_usuario
        varchar(200) email_usuario
        varchar(2000) senha_usuario
        varchar(1000) avatar_usuario
        tinyint ativo_usuario
    }

    WORKSPACE {
        int id_workspace PK
        varchar(200) nome_workspace
        varchar(1000) descricao_workspace
        int id_usuario_admin_fk FK
        tinyint ativo_workspace
    }

    ATIVIDADE {
        int id_atividade PK
        int id_workspace_fk FK
        varchar(500) nome_atividade
        varchar(5000) descricao_atividade
        datetime data_entrega_atividade
        timestamp data_criacao_atividade
        tinyint ativo_atividade
        tinyint concluido_atividade
        timestamp data_concluido_atividade
    }

    membro_workspace {
        int id_membro_workspace PK
        int id_workspace_fk FK
        int id_usuario_fk FK
    }

    membro_atividade {
        int id_membro_atividade PK
        int id_usuario_fk FK
        int id_atividade_fk FK
    }

    USUARIO ||--o{ WORKSPACE : "administra"
    WORKSPACE ||--|{ ATIVIDADE : "contém"
    USUARIO }o--o{ membro_workspace : "participa"
    WORKSPACE }o--o{ membro_workspace : "contém"
    USUARIO }o--o{ membro_atividade : "participa"
    ATIVIDADE }o--o{ membro_atividade : "contém"
```

