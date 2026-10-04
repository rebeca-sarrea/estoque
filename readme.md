# Sistema de Gestão de Estoque

## Objetivo
Sistema simples para controlar os produtos disponíveis no estoque de um mercado:
cadastrar, listar, editar e excluir produtos.

## Tecnologias utilizadas
- PHP
- MySQL
- HTML

## Funcionalidades
- **Listar** (`index.php`): mostra todos os produtos em uma tabela.
- **Cadastrar / Editar** (`form.php` + `salvar.php`): formulário único; valida os dados e grava no banco.
- **Excluir** (`excluir.php`): remove o produto após confirmação.
- Todas as consultas usam **Prepared Statements**.
- Validação dos dados no servidor, tratamento básico de erros com `try/catch`
  e saída escapada com `htmlspecialchars`.