<h3 align="center">
  <img alt="Digital One" src="https://user-images.githubusercontent.com/51726945/85145615-3326c600-b223-11ea-84bf-319fb54949b5.png" />
</h3>

<br>

<h2 align="center">  
  Teste para desenvolvedor Web
</h2>

<br>

A [Digital One](https://www.digitalone.com.br/) está sempre em busca de profissionais com boa capacidade de aprendizado e adaptação, mas principalmente motivação.

Este teste tem como objetivo avaliar seus conhecimentos. Fique tranquilo, caso não consiga concluir o desafio no prazo estipulado, você deve envia-lo da maneira que estiver, pois iremos avaliar a qualidade do que foi desenvolvido. 

## Desafio

- O seu desafio será construir uma aplicação web para controle de publicações com login e recuperação de senha. 

<details>

  <summary>Layout</summary>
  - O layout ficará por sua conta, seja criativo e nos surpreenda!
</details>

<details>

  <summary>Funcionalidades</summary>
   - O Desafio deverá ter as seguintes funcionalidades:
      
   - Cadastro de usuários
   - Recuperação de senha para usuários já cadastrados
   - Login
   - Publicações (Posts)
     - Create
     - Read
     - Update
     - Delete
     - Index (Listagem)
</details>

<details>
  <summary>Banco de dados</summary>

  - O banco de dados a ser utilizado também poderá ser de sua escolha.

  - Você deverá criar as seguintes tabelas no seu banco de dados:

    - Users
      - O usuário terá as seguintes colunas:
        - name: `VARCHAR(245)`
        - email: `VARCHAR(245)`
        - password: `VARCHAR(245)` **deverá ser criptografado**

    - Posts
      - As publicações terão as seguintes colunas:
        - title: `VARCHAR(245)`
        - description: `VARCHAR(245)`
        - img_url: `VARCHAR(245)`
          - **Não será obrigatório o upload de imagens**, poderá ser cadastrado somente com a URL da mesma.
        - created_at: `TIMESTAMP`
        - author: `Criar uma FK (foreign key) para relacionamento com usuário`
</details>

## Regras 

- Deverá ser utilizado PHP como linguaguem de programação.
  - Está liberado o uso de qualquer framework, porém nós utilizamos o CodeIgniter e isso será considerado como diferencial.
- Você também deve utilizar algum padrão de desenvolvimento (ex: MVC, MVVM, MVP, etc...)
- No layout, Você deverá utilizar algum framework CSS (ex: Bootstrap, MaterializeCSS, etc...)
- Faça commits pequenos para que possamos acompanhar a sua linha de raciocínio.
- Após o recebimento do e-mail com esse desafio, você terá 7 dias para desenvolve-lo.

## Por onde começar?

Primeiramente, você pode fazer um fork desse repositório aqui, para sua conta do Github, depois disso crie uma branch nova com o seu nome (ex: nome_sobrenome), para podermos indentificá-lo.

Após terminar o desafio, você pode solicitar um pull request para a branch master do nosso repositório. Vamos receber e fazer a avaliação de todos.

---

## Sobre o Projeto

Este teste foi uma excelente trajetória para a expansão do meu ferramental de
conhecimento, principalmente numa linguagem que nunca me aventurei antes.

Já possuia experiência prévia em Bootstrap, MySQL, Docker e desenvolvimento Web
em geral, porém o CodeIgniter foi um desafio interessante.

Meu maior contato com desenvolvimento PHP foi durantes aulas na faculdade com o
Professor Diogo Muneratto, principalmente com Laravel.

### Setup

Feramentas usadas durante o desenvolvimento:

- `PHP 8.3.12`;
- `Composer 2.7.7`;
- `MariaDB 11.5.2`;
- `CodeIgniter 4.5.5`;
- `Docker 26.1.5-ce` (para desenvolvimento local).

Requerimentos:

- `PHP >= 8.4.12`;
- `Composer >= 2.7.7`;
- `MySQL-compatible database`.

#### Configuração

##### Banco de Dados

Configurar no `.env` variáveis relacionadas a conexão com a base de dados.

Exemplo:
```toml
database.default.hostname = localhost
database.default.database = ci4
database.default.username = root
database.default.password = root
database.default.DBDriver = MySQLi
database.default.port = 3306
```

##### Recuperação de Senha

Configurar no `.env` variáveis relacionadas a configuração da recuperação de senha.

Exemplo:
```toml
# Quantidade máxima de tentativas até o sistema
# ignorar novas tentativas de recuperação de senha.
# (opcional; padrão 20)
app.user.recovery.maxAttempts = 20

# Tempo de expiração padrão para os códigos de
# recuperação de senha.
# (opcional; padrão '+30 min')
app.user.recovery.codeExpiration = '+30 min'
```

##### Envio de Email

Configurar no `.env` variáveis relacionadas a configuração do SMTP para envio
de emails.

> Durante o desenvolvimento foi utilizado o serviço [ethereal.email](https://ethereal.email)
> para testes de envio de email pelo serviço de recuperação de senha.

Exemplo:
```toml
mail.sender.fromEmail = hostmaster@postage.com
mail.sender.fromName = 'HostMaster'
mail.protocol = smtp
mail.smtp.host = smtp.example.com
mail.smtp.user = username
mail.smtp.pass = password
mail.smtp.port = 587
```

#### Preparação do Ambiente

1. `composer install` para instalar as dependências do framework;
2. `php spark migrate` para aplicar as migrações na base de dados.

### Preview

É possível previsualizar o projeto rodando o servidor local do CodeIgniter, com
`php spark serve`.