
<p align="center">
  <img src="https://multiplier.com.br/assets/multiplier.svg" width="320" alt="Nest Logo" />
</p>


# Desafio Back-end Multiplier

O intuito deste teste é avaliar seus conhecimentos técnicos de back-end.

O teste consiste em fazer um sistema para um restaurante.

Este desafio deve ser feito por você em sua casa. Gaste o tempo que você quiser, mas nos conte o tempo que levou para realizar o desafio.

# Tempo necessário

Foi necessário 3 dias úteis para realização do desafio, considerando 1 dia útil de trabalho entre 9:00 e 18:00.

# Github

Link do repositório: 
https://github.com/gabrielbrelaz7/desafio-multiplier-back-end

# Preparação do ambiente

Para que o sistema funcione corretamente em sua máquina local, realize as seguintes etapas.

1. Faça o clone do repositório do Github para sua máquina local
2. Rode o comando "composer install" dentro da pasta do desafio, para instalar todas as dependências do sistema em Laravel
3. Crie duas base de dados em um banco de dados MariaDB, sendo a primeira com nome de multiplier, e a segunda com nome de multiplier_test
4. Inicie a aplicação Laravel utilizando o comando "php artisan serve"
5. Utilize o comando "php artisan migrate --seed" para rodar as migrations e seeds na base de dados multiplier
6. Utilize o comando "php artisan migrate --seed --env=testing" para rodar as migrations e seeds na base de dados multiplier_test  
7. Para realizar os testes, utilize o comando "./vendor/bin/phpunit"
8. Se você chegou nesta etapa com sucesso, você já pode utilizar a API. Recomendo a utilização do programa POSTMAN, para importar o arquivo da collection que está presente neste repositório e utilizar todos os endpoints.


# Instruções de utilização do sistema

1. Existem 3 tipos de usuários no sistema: Gerente, Garçom e Cozinheiro. 
2. Somente gerente pode cadastrar novos usuários no sistema
3. Somente gerente e garçom pode cadastrar clientes
4. Somente gerente pode cadastrar mesas, cardápios e produtos
5. A maioria dos endpoints só funcionam se for utilizado o bearer token do usuário logado no authorization da requisição
6. Somente gerente pode visualizar todos os pedidos e seus filtros de consulta
7. Somente gerente e garçom podem fazer pedidos
8. As demais funcionalidades estão de acordo com o padrão solicitado no desafio



