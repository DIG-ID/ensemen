# CLAUDE.md — Theme Starter Laravel (Digid Theme)

## Language
- Responder sempre em **português de Portugal** no chat.
- Comentários no código devem ser em **inglês (en-EN)**.

---

## Stack

- **WordPress** custom theme (`text-domain: digid`)
- **WooCommerce**
- **Tailwind CSS** + **Laravel Mix** (webpack)
- **PHP 8.0+**
- **SASS** (estrutura modular em `assets/sass/`)
- **JS** em `assets/js/`
- **Dist** compilado em `dist/`

### Dependências JS notáveis
- GSAP, Lenis (smooth scroll), Swiper, Isotope, Fancyapps UI, imagesloaded

---

## Estrutura de Ficheiros

```
theme-starter-laravel/
├── assets/
│   ├── js/
│   └── sass/
│       ├── _vars.sass
│       ├── _base-styles.sass
│       ├── _components/
│       ├── _modules/
│       ├── _pages/
│       ├── _posts/
│       └── main.sass
├── dist/                   # compiled assets (não editar directamente)
├── inc/                    # PHP includes do tema
├── page-templates/         # Page templates WordPress
├── template-parts/
│   ├── pages/
│   │   └── home/
│   ├── footer-main.php
│   ├── header-main.php
│   └── design-system.php
├── functions.php
├── webpack.mix.js
├── tailwind.config.js
├── phpcs.xml.dist
└── style.css
```

---

## Comandos de Desenvolvimento

```bash
# Compilar assets (desenvolvimento)
npm run dev

# Compilar assets (produção)
npm run prod

# Lint PHP (PHPCS)
npm run php:lint

# Auto-fix PHP (PHPCBF)
npm run php:fix
```

---

## Coding Standards

Todo o código PHP **deve** seguir:
- [PHP Coding Standards (PHPCS)](https://github.com/PHPCSStandards/PHP_CodeSniffer/)
- [WordPress Coding Standards](https://github.com/WordPress/WordPress-Coding-Standards)

Regras activas (ver `phpcs.xml.dist`): `WordPress-Core`, `WordPress-Docs`, `WordPress-Extra`.

Antes de entregar código PHP, verificar com `npm run php:lint`. Usar `npm run php:fix` para correcções automáticas.

---

## Custom Post Types

| Slug    | Descrição              |
|---------|------------------------|
| `blog`  | Artigos de blog        |
| `event` | Eventos com data/local |

---

## ACF Field Groups

### CPT `blog` — grupo `blog_cpt`
| Campo                  | Tipo  | Notas              |
|------------------------|-------|--------------------|
| `blog_cpt.description` | text  |                    |
| `blog_cpt.button`      | link  | retorna array       |
| `blog_cpt.image`       | image | retorna ID          |

### CPT `event` — grupo `events_cpt`
| Campo                          | Tipo              | Notas                          |
|--------------------------------|-------------------|--------------------------------|
| `events_cpt.title`             | text              |                                |
| `events_cpt.description`       | textarea          |                                |
| `events_cpt.image`             | image             | retorna ID                     |
| `events_cpt.time`              | text              | **legado** — preferir `event_date` |
| `events_cpt.date`              | text              | **legado** — preferir `event_date` |
| `events_cpt.event_date.start`  | date_time_picker  | formato `Y-m-d H:i:s`         |
| `events_cpt.event_date.end`    | date_time_picker  | formato `Y-m-d H:i:s`         |
| `events_cpt.place`             | text              |                                |
| `events_cpt.small_description` | textarea          |                                |
| `events_cpt.button`            | link              | retorna array                  |

### Page Template `page-templates/page-faq.php` — FAQ CF
- `title` (text)
- `faq` (repeater) → `title` + `faq_accordion` (repeater nested) → `question` + `response`

### Page Template `page-templates/page-distellerie.php` — Distellerie CF
- `hero` group: `background`, `background_tablet`, `title`, `description`, `button`
- `craftmanship` group: `image_1`–`image_4`, `title`, `sub_title`, `description`, `button`, `gallery_title`, `gallery_title_2`, `gallery`
- `gin_makes_history` group: `title`, `subtitle`, `image`, `image_title`, `image_description`

### Page Template `page-templates/distillery-Aktienmühle.php`
- `distillery_aktienmuhle` group: `title`, `subtitle`, `description`, `subtitle2`, `description2`, `contact`, `address`, `swiper`
- `our_experience` group: `over_title`, `title`, `description`, `background_image_desktop/tablet/mobile`, `button`

### Page Template `page-templates/page-experiences.php` — Erlebnisse CF
- `hero` group: `title`, `background`, `description`
- `events` group: `background_image`, `over_title`, `title`, `description`

---

## SEO / Schema

- Plugin: **Yoast SEO** (`wordpress-seo`)
- Schema customizado via **Yoast Schema API** — usar filtros `wpseo_schema_graph_pieces` e `wpseo_schema_*`
- Não criar schema manual com `wp_head` se o Yoast já o suportar.

| Contexto     | Schema                  | Campos principais                              |
|--------------|-------------------------|------------------------------------------------|
| CPT `event`  | `schema.org/Event`      | `event_date.start`, `event_date.end`, `place`  |
| CPT `blog`   | `schema.org/Article`    | Coberto pelo Yoast por omissão                 |
| Page FAQ     | `schema.org/FAQPage`    | Mapear `faq` → `faq_accordion` → `question`/`response` |

---

## Plugins

> Atenção: alguns plugins são **apenas locais** (debug, query monitor, etc.) e não estão em produção.

Plugins activos relevantes para desenvolvimento:
- `advanced-custom-fields-pro` — campos ACF
- `sitepress-multilingual-cms` (WPML) + `woocommerce-multilingual` + `wpml-string-translation` — multilíngue
- `woocommerce` + `woocommerce-gateway-stripe` + `flexible-coupons-pro` — loja
- `contact-form-7` — formulários
- `wordpress-seo` (Yoast) — SEO/Schema
- `age-gate` — verificação de idade
- `mailchimp-for-wp` — newsletter
- `safe-svg` — SVG upload
- `woo-variation-swatches` — variações de produto visuais

**Regra:** Não usar plugins adicionais. Preferir código no tema ou plugins já instalados.

---

## Convenções Gerais

- Não usar plugins desnecessários — preferir código no tema.
- Não instalar dependências npm ou composer sem confirmação explícita.
- Ao adicionar template parts, seguir a estrutura existente em `template-parts/`.
- Assets CSS/JS devem ser compilados via `npm run dev` / `npm run prod` — nunca editar `dist/` directamente.
- Para campos ACF legados (`time`, `date`), usar sempre `event_date.start` / `event_date.end` em código novo.
- Text domain do tema: `digid`.
