# Sistema de Presenças - Backend

Este é o backend do Sistema de Presenças para a Escola SchoolFreq, desenvolvido em Node.js e Express, com um banco de dados MySQL.

## Índice

- [Instalação e Configuração](#instalação-e-configuração)
- [Rotas e Funcionalidades](#rotas-e-funcionalidades)
- [Tecnologias Utilizadas](#tecnologias-utilizadas)
- [Testes e Execução](#testes-e-execução)

## Instalação e Configuração

### Pré-requisitos:

- Node.js
- MySQL
- PM2 (para deploy)

### Para configurar o projeto:

1. Clone o repositório:
   ```bash
   git clone https://github.com/giselemascarenhas/professional-practice-project.git
   cd schoolfreq-api/backend

   ```

2. Instale as dependências:
   ``` 
   npm i
   ```

3. Para executar o projeto:

- ##### Em ambiente de desenvolvimento:
   ``` 
   npm run dev
   ```

- ##### Em ambiente de produção:
   ``` 
   sudo npm i pm2 -g
   pm2 start app.js
   ```

## Rotas e Funcionalidades

### Rotas de Agenda:
- `GET` **/agenda:** Retorna todas as agendas.
- `GET` **/agenda/:id:** Retorna uma agenda específica pelo ID.
- `GET` **/agenda/:data/:prof:** Retorna todas as agendas de um professor em uma data específica.

### Rotas de Aluno:
- `GET` **/aluno:** Retorna todos os alunos.
- `GET` **/aluno/:id:** Retorna um aluno específico pelo ID.

### Rotas de Disciplina:
- `GET` **/disciplina:** Retorna todas as disciplinas.
- `GET` **/disciplina/ativas:** Retorna disciplinas ativas.
- `GET` **/disciplina/:id:** Retorna uma disciplina específica pelo ID.

### Rotas de Faltas:
- `GET` **/falta:** Retorna todas as faltas.
- `GET` **/falta/:id:** Retorna uma falta específica pelo ID.
- `POST` **/falta:** Cria uma nova falta.
- `PATCH` **/falta/:id:** Atualiza uma falta existente.
- `DELETE` **/falta/:id:** Remove uma falta existente.

### Rotas de Professor:
- `GET` **/professor:** Retorna todos os professores.
- `GET` **/professor/:id:** Retorna um professor específico pelo ID.

### Rotas de Turma:
- `GET` **/turma:** Retorna todas as turmas.
- `GET` **/turma/:id:** Retorna uma turma específica pelo ID.



## Tecnologias Utilizadas
- Linguagens: JavaScript (Node.js).
- Frameworks e Bibliotecas: Express, MySQL2.
- Ferramentas de Testes: Postman.
- Deploy: PM2.
- Banco de Dados: MySQL.

## Testes e Execução
- Em ambiente de desenvolvimento: Use `npm run dev` para iniciar o backend.
- Para testes manuais: Utilize ferramentas como Postman para enviar requisições HTTP e verificar as respostas.
