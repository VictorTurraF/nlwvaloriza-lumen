![Continuous Integration](https://github.com/VictorTurraF/nlwvaloriza-lumen/actions/workflows/laravel.yml/badge.svg)

# NLW Valoriza - Lumen PHP Framework

Implementação do projeto [NLW Valoriza](https://github.com/VictorTurraF/nlwvaloriza/) com o objetivo de conhecer o Lumen PHP Micro-Framework. Documentação pode ser encontrada no [Lumen website](https://lumen.laravel.com/docs).

## Test Driven Development
Primeiro um teste falhando de forma esperada, depois é escrita a funcionalidade para satizfazer os requisitos do teste. Resultando em uma melhor cobertura de testes e especificação/documentação completa da aplicação.
![nlw-lumen-tests](https://user-images.githubusercontent.com/59932737/167952786-097c9b6c-ee2e-4099-881a-4a44fc0ffde3.gif)

### Test Whatching
Utilização da biblioteca [spatie/phpunit-watcher](https://github.com/spatie/phpunit-watcher) para rodar os testes a cada alteração no código.
![nlw-lumen-test-watcher](https://user-images.githubusercontent.com/59932737/167953626-4ce52036-22a7-48df-9514-007173c9781e.gif)

## Docker para desenvolvimento
Imágem docker com Dockerfile e docker-compose para gerenciar todos os serviços.
![nlw-lumen-docker](https://user-images.githubusercontent.com/59932737/167955264-20650401-8164-4733-8594-5097987b7ee4.gif)

## Messagens de commit baseadas em Conventional e Atomic commits
Messagens de commit baseadas em [conventional commits](https://www.conventionalcommits.org/en/v1.0.0/#specification) e também seguindo a filosofia dos commits atômicos onde cada commit contém um conjunto de alterações que representa uma funcionalidade da aplicação que foi testada e funciona corretamente, não sendo inserido nenhum commit no qual comprometa o funcionamento da aplicação em qualquer momento específico do histórico de versão.
![conventional_commits](https://user-images.githubusercontent.com/59932737/167523422-46beb679-ef11-404e-a82d-e38611a7859f.gif)

## Stateless Authentication
O metodo de autenticação utilizado foi *Stateless Authentication* utilizando JWT (*Json Web Token*) por meio da biblioteca [jwt-auth](https://jwt-auth.readthedocs.io/en/develop/).
![auth](https://user-images.githubusercontent.com/59932737/167521079-1b6bd527-2910-4f9b-8cec-8bcf339bb821.gif)
![auth_request](https://user-images.githubusercontent.com/59932737/167521116-278c7701-5b0e-483e-9489-cedfc30cbc78.gif)

## Futuras Melhorias

- [ ] Separar a lógica da aplicação em camadas (Controller, Service, Repository);
- [ ] Adicionar testes de unidades;
- [ ] Fazer deploy automatizado em produção.
