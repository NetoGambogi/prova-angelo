# 🪄 Sistema de Gestão de Hogwarts

## 👥 Grupo
**Luis Antônio Gambogi, Mateus Coimbra, Giovanne Bartelega, Bruna Marques, Rhuan Martins, Thales Barreto, Nickson, Thiago Mariano, Rafael Melo, Felipe Carvalho**

---

## 📋 Sumário
- [Instruções para Execução do Sistema](#instruções-para-execução-do-sistema)
- [Responsáveis pelos Módulos](#responsáveis-pelos-módulos)
  - [Módulo 1 e 2 - Convite, Cadastro e Seleção de Casas](#módulo-1-e-2---convite-cadastro-e-seleção-de-casas)
  - [Módulo 3 - Gerenciamento de Torneios e Competições](#módulo-3---gerenciamento-de-torneios-e-competições)
  - [Módulo 4 - Controle Acadêmico e Disciplinar](#módulo-4---controle-acadêmico-e-disciplinar)
  - [Módulo 5 - Gerenciamento de Professores e Funcionários](#módulo-5---gerenciamento-de-professores-e-funcionários)
  - [Módulo 6 - Sistema de Alertas e Comunicação](#módulo-6---sistema-de-alertas-e-comunicação)

---

## 🚀 Instruções para Execução do Sistema

Será necessário executar o arquivo diretamente no terminal, preferencialmente utilizando o seguinte comando:

```bash
php app.php
```

Isso garante que o script seja interpretado corretamente pelo PHP no ambiente de linha de comando.  
Executar pelo terminal é importante porque algumas funcionalidades, como entrada e saída interativas (exemplo: `readline`), podem não funcionar adequadamente em outros ambientes, como IDEs ou navegadores.

Dessa forma, o script será iniciado da maneira esperada e todas as interações ocorrerão corretamente.

---

## 🛠️ Responsáveis pelos Módulos

---

## Módulo 1 e 2 - Convite, Cadastro e Seleção de Casas
**Responsáveis:** Thales, Nickson, Rhuan

### Descrição
Este módulo realiza o registro de alunos no sistema escolar de Hogwarts, incluindo alunos novos e veteranos.

#### Funcionalidades:
- Cadastro de **Alunos Novos**
  - Idade automática: 11 anos
  - Matrícula no 1º ano
  - Envio de carta de aceitação

- Cadastro de **Alunos Veteranos**
  - Escolha do ano escolar (1 a 7)
  - Idade automática: 10 anos + ano escolhido

- **Seleção de Casas Automática**
  - Baseada no traço de personalidade:
    - Coragem → Grifinória
    - Ambição → Sonserina
    - Lealdade → Lufa-Lufa
    - Inteligência → Corvinal

- **Confirmação da Carta de Aceitação**
  - Apenas alunos que aceitarem podem acessar o sistema.

> 📌 *Observação:* A carta não pode ser enviada para alunos com menos de 11 anos.

---

### Instruções de Execução

O sistema é extremamente intuitivo e de fácil utilização.

**Passo a Passo:**
1. Acesse o terminal.
2. Digite o comando:
    ```bash
    php app.php
    ```
3. Pressione **1 ou 2** para iniciar o cadastro.

---

## Módulo 3 - Gerenciamento de Torneios e Competições
**Responsáveis:** Thiago, Rafael

### Descrição
Simula um **Torneio Tribruxo** em Hogwarts.

- O sistema cria alunos, casas e envia convites personalizados.
- O usuário decide se cada aluno aceita ou recusa participar.
- Um desafio é criado e as casas participantes são avaliadas com notas.
- Gera-se um ranking final das casas.

### Modo de Uso
Execute o código no terminal e siga as instruções apresentadas.

---

## Módulo 4 - Controle Acadêmico e Disciplinar
**Responsáveis:** Mateus, Luis Antônio

### Descrição
A arquitetura do módulo foi construída em **três camadas:**

- **Modelos:** Representam dados como Aluno, Professor e Casa.
- **Serviços:** Contêm toda a lógica e as regras do sistema.
- **Apresentação:** Interface com o usuário (script `modulo4.php`).

#### Destaque:
Foi utilizada a **NotificadorInterface**, que permite que o sistema seja facilmente adaptável, desacoplando a lógica de negócio da interface de exibição.

---

## Módulo 5 - Gerenciamento de Professores e Funcionários
**Responsáveis:** Giovanne, Bruna

### Descrição
Gerencia de forma centralizada todas as informações dos professores.

### Funcionalidades:
- Cadastro de novos professores.
- Criação de turmas, associando disciplinas e horários.
- Registro de atividades extracurriculares.
- Consulta de cronograma completo.

### Instruções de Execução:
1. No menu principal, digite **5** e pressione Enter.
2. Um novo menu específico será exibido.
3. Escolha a ação desejada (ex: Cadastrar Professor, Consultar Cronograma).
4. O sistema guiará todo o processo.
5. Para retornar ao menu principal, digite **0**.

---

## Módulo 6 - Sistema de Alertas e Comunicação
**Responsável:** Felipe

### Descrição
Este módulo moderniza a comunicação entre professores e alunos, simulando um sistema de mensagens e notificações digitais.

- Substitui o envio tradicional de recados por corujas.
- Permite notificações instantâneas e agendadas.
- Proporciona uma comunicação prática, eficiente e organizada dentro do sistema.

### Funcionalidades:
1. Enviar notificação imediata: Responsavel por enviar uma mensagem imediatamente para todos os alunos.
2. Agendar aviso para depois: Realiza um agendamento de uma mensagem, sendo enviada no dia e hora exata que for colocado.
3. Fila de mensagens: Processa e envia todas as mensagens agendadas cujo horário já chegou.
4. Avisos escolares: Lista todas as notificações enviadas.
5. Confirmar leitura de mensagens: Marcar uma mensagem como lida.
6. Sair do sistema: Finaliza o programa.