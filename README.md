# Ix-Sistemas

> **Projeto acadêmico arquivado.** Projeto final de curso técnico, desenvolvido em grupo em 2021. Não recebe mais atualizações.
>
> A ideia foi reescrita do zero em 2026 com stack atual: [restaurante-txtech](https://github.com/LucasTeixeira-Dev/restaurante-txtech).

Sistema de apoio a restaurantes, bares e lanchonetes: cardápio, mesas, pedidos e controle de usuários por perfil.

Código de estudo, mantido como registro. Não foi pensado para uso em produção, e as credenciais nos arquivos de configuração são apenas exemplos.

## Funcionalidades

- Login com quatro perfis: gerente, chapeiro, caixa e garçom
- Cardápio com visões separadas para gerente, funcionário e cliente
- Cadastro de mesas
- Abertura e acompanhamento de pedidos, com tela de detalhes
- Cadastro de usuários
- App mobile com cardápio e carrinho

## Stack

| Camada | Tecnologias |
|---|---|
| API | PHP (PDO) |
| Banco de dados | MySQL |
| Web | HTML, CSS, JavaScript, jQuery |
| Mobile | Ionic 5, Angular 11 |

## Estrutura

| Pasta | Conteúdo |
|---|---|
| `src/domain` | Classes de domínio e conexão com o banco |
| `src/controll` | Rotas e processamento da API |
| `view` | Telas web |
| `RestauranteAPP` | App mobile (Ionic) |
| `Documentacao` | DER, MER, diagrama de classes, requisitos, cronograma e apresentação |
| `restaurantesBD.sql` | Script de criação do banco |

## Equipe

Projeto desenvolvido em grupo de quatro pessoas. O histórico de commits registra a contribuição de cada integrante.

## O que mudou na reescrita

O [restaurante-txtech](https://github.com/LucasTeixeira-Dev/restaurante-txtech) parte do mesmo domínio e troca a base técnica: Laravel 11 no lugar de PHP puro, React e React Native no lugar de jQuery e Ionic, autenticação com Sanctum, cozinha em tempo real (KDS), estoque, caixa, relatórios e ambiente em Docker.
