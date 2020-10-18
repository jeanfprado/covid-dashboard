## Sobre o Projeto

Sistema desenvolvimento pela turma do 6º Periodo de Analise e Desenvolvimento de Sistemas, como trabalho de apresentação do 
**VIII Workshop Profissional** na FAMAIS/FASG - Faculdade São Gabriel da Palha.

## Api Usadas

[https://brasil.io/]

[https://covid19-brazil-api-docs.now.sh/]

## Instalação

Primeiro você vai precisar criar as tabelas no banco de dados:

```
php artisan migrate
```

Já com as tabelas criadas agora vamos carregar os dados com base em um arquivo.
O mesmo se encontra no caminho: `storage/app/caso.csv` : Data da última atualização 16/10/2020

```
php artisan covid:seed-cases --source=file
```

## Integrantes

Dierli Matos.

Mateus dos Reis.

Joel Ernandes.

Diego Ponath.

Gustavo Antonio.

Clóvis Pinaffo.

Milena Haidiman.

Adailton Lucas.

Douglas dos Reis.

## Professor Orientador

Prof. Jean de Freitas Prado.

## License

O Projeto é open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
