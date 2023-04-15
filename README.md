# Oficina 2.0

## Desafio

Construir uma API Simples em Laravel(PHP) e Front com VUE3 que permitisse Listar,Criar, Atualizar e Deletar Orçamentos,
 bem como pesquisar por Nome do cliente, nome do vendedor e o intervalos de data de criação.

## Descrição

A API da Oficina que o vendedor possam criar, listar, ler, editar e deletar orçamentos e fazer pesquisas através do nome do cliente, do nome do vendedor
e da data de criação.

**Exemplo: Tela da Listagem de Orçamento**

![image](https://user-images.githubusercontent.com/57235071/232242423-28c82172-fe93-4ebf-89fb-189b9e27363f.png)

Para editar as informações de um orçamento específico, o usuário deve acessar a telar de editar clicando no botão -EDITAR- na listagem dos orçamentos.

**Exemplo: Tela de Edição de Orçamento**

![image](https://user-images.githubusercontent.com/57235071/232242495-6bc3b31a-1ff6-4d86-a3e0-a004ec0cbc71.png)


### Como executar o projeto (Linux)
Clone Repositório
```sh
git clone
```

Entre na pasta
```sh
cd teste_back_front
```

Remova a pasta .git
```sh
rm -rf .git/
```

Entre na pasta oficina
```sh
cd oficina
```

Crie o Arquivo .env
```sh
cp .env.example .env
```

Se for preciso, Atualize as variáveis de ambiente do arquivo .env
```
APP_NAME=Pontue
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=budget
DB_USERNAME=admin
DB_PASSWORD=password
```
Suba os containers do projeto
```sh
docker compose up -d
```

Acessar o container
```sh
docker compose exec budget_web bash
```

Instalar as dependências do projeto
```sh
composer install
```

Gerar a key do projeto Laravel
```sh
php artisan key:generate
```

Criar o banco de dados com os seeders
```sh
php artisan migrate --seed
```

Rodar os Testes
```sh
./vendor/bin/pest
```

### Route List

![image](https://user-images.githubusercontent.com/57235071/232242549-be234b5b-30ad-428d-be57-ff9863616b5d.png)

### Frontend com Vue3

Entre na pasta oficina_front
```sh
cd oficina_front
```

Instale as dependncias da aplicação
```sh
npm install
```

Entre na pasta oficina_front
```sh
npm run dev
```


### Exemplo de outros Projetos
- [API de Filmes com Comentários](https://github.com/EuclidesKinto/movie_api).
- [Construção de um ADMIN com ACL(Access Control List)](https://github.com/EuclidesKinto/filament-acl).
- [4 projetos com Vue3](https://github.com/EuclidesKinto/vue-projects).
- [Componentes Blade - Laravel](https://github.com/EuclidesKinto/components).
- [Conversor de Moedas com Vue3](https://github.com/EuclidesKinto/conversor-moedas).
- [Projeto Site UXDesign - Trabalho da Faculdade](https://github.com/EuclidesKinto/trabalho-ux-html).
- [Projeto em Nuxtjs](https://github.com/EuclidesKinto/lu_estilo_front).
- [API em Golang](https://github.com/EuclidesKinto/backend_api).

