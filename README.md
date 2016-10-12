# Photo Viewer

O [Photo Viewer](http://rd2m.com/maxmilhas-test/) é uma aplicação web desenvolvida como parte do Teste de Codificação Back-end para a vaga de desenvolvedor na **MaxMilhas**.

Ele é uma aplicação web onde é possível cadastrar fotos, ver a lista de fotos cadastradas e também excluir fotos. As fotos cadastradas são exibidas como uma galeria onde o usuário navega e visualiza uma foto por vez.

A aplicação foi desenvolvida utilizando PHP 5.6.

Você pode ver uma [demonstração](http://rd2m.com/maxmilhas-test/) antes de instalar na sua máquina.

## Instalação

1. Abra o terminal e faça um `git clone` deste repositório para um diretório da sua máquina;
2. Na pasta raíz do projeto, execute o execute o comando `composer install` (estou considerando o Composer [instalado globalmente](https://getcomposer.org/doc/00-intro.md#globally).
3. Execute no seu MySQL o script de banco de dados que está em `src/Config/modelo-de-dados.sql`;
4. Configure os parâmetros de conexão com o seu banco de dados no arquivo `src/Config/photoviewer.ini`;
5. Você está pronto para usar!

### Nota

- A aplicação foi desenvolvida no ambiente `MAMP`, mas você pode executá-la também com `php -S localhost:8000` sem problemas.

## Documentação

A [documentação da API do projeto](http://rd2m.com/maxmilhas-test/docs/api/index.html) foi gerada através do phpDocumentor 2.8\. Para ter uma visão geral das classes da aplicação, além da própria [documentação](http://rd2m.com/maxmilhas-test/docs/api/index.html), não deixe de ver o [diagrama de hierarquia de classes](http://rd2m.com/maxmilhas-test/docs/api/graphs/class.html).

## Testes unitários

A aplicação tem como dependência de desenvolvimento o PHPUnit 5.6, mas infelizmente NÃO foram feitos muitos testes unitários. Foram feitos apenas alguns para evidenciar que **sei configurar** o ambiente para testes (PHPUnit, phpunit.xml, xDebug, code coverage report, etc) e que sei o que é um teste unitário.

Só para constar, o [code coverage report do projeto](http://rd2m.com/maxmilhas-test/tests/data/coverage/index.html) mostra que foi coberto **apenas 6,4%** do código :( mas não se preocupe. Posso fazer bem melhor do que isso _com mais tempo_ na próxima release do "projeto".

Ah! O intuito inicial era não apenas fazer testes unitários, mas também usar **TDD** ([clique aqui](https://github.com/renattomartins/photo-viewer/blob/develop/tests/uploads/photos/tdd.jpg)) com _Red-Green-Refactor_ e tudo mais, mas não foi possível - sendo bem franco - devido a minha não muito grande experiência em testes unitários, e principalmente, devido ao tempo reduzido.

## Sobre o ambiente de desenvolvimento

- PHP 5.6.25
- PDO
- Composer 1.2.1
- PSR-2 Coding Style Guide
- PSR-4 Autoloading Standard
- MySQL 5.6.28
- PHPUnit 5.6.1
- PHP CS Fixer (Coding Standards) 1.12.0
- PHP_CodeSniffer version 2.7.0
- PHPMD (Mess Detector) 2.4.3
- phpDocumentor version v2.8.5
- HTML5 Boilerplate 5.3.0
- jQuery 1.11.2
- Atom 1.10.2. Packages:
	- atom-autocomplete-php
	- linter-php
	- atom-beautify (with PHP-CS-Fixer)
	- linter-phpcs (with PHP_CodeSniffer and PSR-2)
	- linter-phpmd (with PHP Mess Detector)
- Git 2.8.1
- GitHub
- GitFlow Workflow (**muito bom isso**)
- Tower 2.4.0 for OSx

## Histórias de usuário implementadas

**Como usuário do sistema Photo Viewer eu quero cadastrar uma nova foto para que eu possa visualizá-la posteriormente.**

Critérios de aceitação:

1. O usuário verá um formulário com um único campo: Carregar nova foto;
2. O usuário não conseguirá submeter os dados ao servidor se houver algum campo único da tela estiver vazio (validação client-side);
3. O usuário não conseguirá salvar os dados enviados ao servidor se estiver faltando o campo único (validação server-side);
5. O usuário verá botões para salvar e cancelar;
6. Ao clicar no botão de salvar, a foto será persistida.

**Como usuário do sistema Photo Viewer eu quero acessar uma foto para que eu possa visualizá-la.**

Critérios de aceitação:

1. O usuário poderá acessar a representação HTML de uma foto através de uma URL única;
2. O usuário visualizará os botões “>” e “<“ para, respectivamente, avançar à foto seguinte e retroceder a imagem anterior;
3. Ao clicar no botão “>”, o usuário deve ver a foto seguinte;
4. Se a foto exibida for a última, o botão ">" não faz nada e deve estar em estado desativado;
5. Ao clicar no botão “<“, o usuário deve ver a foto anterior;
6. Se a foto exibida é a primeira, o botão "<" não faz nada e deve estar em estado desativado;
7. Ao navegar pelos botões “<“ e “>”, as fotos devem ser exibidas na ordem em que foram cadastradas;
8. O usuário verá o botão de excluir foto.

**Como usuário do sistema Photo Viewer eu quero excluir uma foto para que possa manter minha galeria enxuta e descartar fotos desnecessárias.**

Critérios de aceitação:
1. Ao clicar no botão de excluir, a foto será excluída do banco de dados e do sistema de arquivos;
2. O usuário verá uma mensagem de confirmação em caso de sucesso (e uma de erro em caso de falha) após tentar excluir a foto.
