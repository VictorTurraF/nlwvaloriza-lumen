![Continuous Integration](https://github.com/VictorTurraF/nlwvaloriza-lumen/actions/workflows/laravel.yml/badge.svg)

# NLW Valoriza - Lumen PHP Framework

Implementação do projeto [NLW Valoriza](https://github.com/VictorTurraF/nlwvaloriza/) com o objetivo de conhecer o Lumen PHP Micro-Framework. Documentação pode ser encontrada no [Lumen website](https://lumen.laravel.com/docs).

# Autenticação
O metodo de autenticação utilizado foi *Stateless Authentication* utilizando JWT (*Json Web Token*) com o auxílio da biblioteca [jwt-auth](https://jwt-auth.readthedocs.io/en/develop/).
![auth](https://user-images.githubusercontent.com/59932737/167521079-1b6bd527-2910-4f9b-8cec-8bcf339bb821.gif)
![auth_request](https://user-images.githubusercontent.com/59932737/167521116-278c7701-5b0e-483e-9489-cedfc30cbc78.gif)

# Futuras Melhorias

- [ ] Separar a lógica da aplicação em camadas (Controller, Service, Repository);
- [ ] Adicionar testes de unidades;
- [ ] Fazer deploy automatizado em produção.
