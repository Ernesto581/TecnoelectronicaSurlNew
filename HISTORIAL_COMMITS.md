# Historial de Commits — TecnoelectronicaSurLaravel

Proyecto iniciado el **2026-07-03** con **19 commits** en total. A continuación se explica cada fase del desarrollo.

---

## Fase 1: Fundación del proyecto (3 commits)

| Commit | Fecha | Descripción |
|--------|-------|-------------|
| `846aff7` | 2026-07-03 | **Primer commit** — Proyecto Laravel inicial. |
| `6ce0fec` | 2026-07-04 | Agrega campo `rol` al modelo de usuarios, con roles `admin` y `customer`. |
| `eed8d66` | 2026-07-04 | Añade modelos `Product` y `Category` con migraciones para un esquema completo de e-commerce. |

El proyecto arranca con la estructura base de Laravel y se define el núcleo del dominio: usuarios con roles, productos y categorías.

---

## Fase 2: Sistema de órdenes y documentación (4 commits)

| Commit | Fecha | Descripción |
|--------|-------|-------------|
| `eb59a1b` | 2026-07-04 | Agrega sistema de carrito y órdenes con items (`Cart`, `Order`, `OrderItem`). |
| `7943aa6` | 2026-07-04 | Instala **Scribe** para generación de documentación de API. |
| `9f95b05` | 2026-07-04 | Añade anotaciones PHPDoc a todos los enums y modelos. |
| `b434af4` | 2026-07-04 | Añade anotaciones PHPDoc a factories y seeders. |

Se completa el dominio de negocio (productos, categorías, carrito, órdenes) y se invierte en documentación automática vía Scribe y PHPDoc.

---

## Fase 3: Autenticación y frontend (3 commits)

| Commit | Fecha | Descripción |
|--------|-------|-------------|
| `5b9bfe1` | 2026-07-04 | Instala **Laravel Breeze** para scaffolding de autenticación. |
| `5c19bc7` | 2026-07-04 | Configura **Tailwind CSS** y **Vite** en el frontend. |
| `7d019b5` | 2026-07-04 | Agrega assets públicos y actualiza `.gitignore`. |

Se monta la capa de autenticación con Breeze y se prepara el tooling de frontend con Vite y Tailwind.

---

## Fase 4: Controladores, rutas y administración (6 commits)

| Commit | Fecha | Descripción |
|--------|-------|-------------|
| `94c49a2` | 2026-07-05 | Agrega `StoreController`, `ProductController`, rutas y form requests. |
| `23fd5e5` | 2026-07-05 | Crea `AdminMiddleware` y lo registra como alias `'admin'`. |
| `be6e087` | 2026-07-05 | Pasa productos y categorías a la vista de perfil del admin. |
| `be35be9` | 2026-07-05 | Añade **policies de autorización** para Product, Category y Order. |
| `1102594` | 2026-07-05 | Crea las vistas CRUD de productos del admin (index, show, create, edit). |
| `be6c659` | 2026-07-05 | Mueve el CRUD de productos del admin al perfil, rediseñando la página de perfil. |

Se construye la lógica de negocio con controladores RESTful, middleware de admin, form requests y políticas de autorización. Las vistas admin se crean y luego se reorganizan hacia el perfil.

---

## Fase 5: Correcciones y limpieza final (3 commits)

| Commit | Fecha | Descripción |
|--------|-------|-------------|
| `38d0007` | 2026-07-05 | Reemplaza `{{ $slot }}` por `@yield` para soportar layouts tanto por extensión como por componente. |
| `99fcb96` | 2026-07-05 | Extiende `BaseController` en `Controller` para heredar los métodos `middleware()`, `authorize()` y `validate()`. |
| `f43a9ed` | 2026-07-05 | Limpieza de controladores: elimina redundancia y resuelve violaciones del **principio de responsabilidad única (SRP)**. |

La fase final refactoriza y estabiliza el código. Se corrige el problema de layouts Blade, se mejora la herencia de controladores y se aplican buenas prácticas de arquitectura.

---

## Resumen de convenciones de commits

| Tipo | Significado | Apariciones |
|------|-------------|-------------|
| `feat` | Nueva funcionalidad | 8 |
| `fix` | Corrección de bug | 2 |
| `refactor` | Reorganización de código | 2 |
| `docs` | Documentación | 2 |
| `chore` | Tareas de mantenimiento/configuración | 2 |

---

## Evolución general

El proyecto sigue una progresión lógica:

1. **Dominio** → Usuarios con roles, productos, categorías, carrito y órdenes.
2. **Documentación** → Scribe + PHPDoc para API y modelos.
3. **Frontend** → Breeze (auth) + Vite + Tailwind.
4. **Backend** → Controladores, middleware, policies, form requests y vistas CRUD.
5. **Refactor** → Reorganización de rutas/vistas y limpieza de controladores aplicando SRP.
