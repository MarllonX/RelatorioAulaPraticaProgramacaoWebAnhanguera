# Consulta de Signo Zodiacal

Aplicação web desenvolvida como relatório de aula prática da disciplina de **Programação WEB** — 5º Período de BSI.

---

## Objetivo

Permitir que o usuário informe sua data de nascimento e receba como resultado o nome e a descrição do seu signo zodiacal, com base em consulta a um arquivo XML.

---

## Estrutura de arquivos

```
├── index.php       Formulário de entrada (data de nascimento)
├── resultado.php   Lógica de consulta ao XML e exibição do resultado
├── data.xml        Base de dados dos 12 signos zodiacais
└── style.css       Estilização das duas páginas
```

---

## Desenvolvimento

### Formulário (`index.php`)
Página inicial com um campo `<input type="date">` e um botão de envio. O formulário utiliza o método `POST` para transmitir a data à página de resultado sem expô-la na URL.

### Resultado (`resultado.php`)
Recebe a data via `$_POST`, valida o campo e converte o valor para um número inteiro no formato `MMDD` (ignorando o ano, já que os períodos dos signos se repetem anualmente). Em seguida, percorre os elementos `<signo>` do XML comparando o número extraído com os intervalos de cada signo.

Um cuidado especial foi adotado para **Capricórnio**, cujo período cruza a virada do ano (22/12 → 19/01): quando o início do intervalo é numericamente maior que o fim, a verificação usa `OR` em vez de `AND`.

Todos os dados exibidos ao usuário passam por `htmlspecialchars()` para prevenir XSS.

### Base de dados (`data.xml`)
Arquivo XML com os 12 signos. Cada entrada contém `<nome>`, `<inicio>` (MM-DD), `<fim>` (MM-DD) e `<descricao>`. A leitura é feita com `simplexml_load_file()`.

### Estilização (`style.css`)
Layout responsivo centralizado com CSS Grid. Utiliza variáveis CSS (`custom properties`) para o tema de cores, efeito *glassmorphism* no card central e media query para telas compactas (≤ 480 px).

---

## Como executar

É necessário um servidor PHP local (ex.: XAMPP, Laragon ou o servidor embutido do PHP).

```bash
# Na pasta do projeto
php -S localhost:8000
```

Acesse `http://localhost:8000` no navegador.

---

## Tecnologias utilizadas

| Tecnologia | Uso |
|---|---|
| PHP 8+ | Lógica de back-end e leitura do XML |
| HTML5 | Estrutura das páginas |
| CSS3 | Estilização e responsividade |
| XML | Armazenamento dos dados dos signos |
